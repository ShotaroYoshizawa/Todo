<?php

namespace App\Models;

use Carbon\Carbon; // ★追加
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
  
    /**
     * 状態定義
     * label-warning, label-danger, label-info, label-success, label-defaultは
     * Bootstrapですでに定義されているクラス名
     * https://webnetamemo.com/coding/bootstrap3/20150627154
     */
    const STATUS = [
        1 => ['label' => '未着手', 'class' => 'label-warning'],
        2 => ['label' => '進捗遅れ', 'class' => 'label-danger'],
        3 => ['label' => '進捗順調', 'class' => 'label-info'],
        4 => ['label' => '進捗前倒し', 'class' => 'label-success'],
        5 => ['label' => '完了', 'class' => 'label-default'],
    ];

    /**
     * 状態のラベル
     *
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        // 状態値
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        if (! isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];
    }
  
    /**
     * 状態の色を指定したHTMLクラスを返す
     * クラス:label-warning,label-danger,label-info,label-success,label-default
     * はBootstrapですでに定義されているクラス名
     *
     * @return string
     */
    public function getStatusClassAttribute()
    {
        // 状態値
        $status = $this->attributes['status'];

        // 定義されていなければ空文字=クラスなし を返す
        if (! isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['class'];
    }

    /**
     * 整形した期限日のフォーマットを変更
     *
     * @return string
     */
    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])
            ->format('Y/m/d');
    }

}