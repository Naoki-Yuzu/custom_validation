<?php

namespace App\Rules;

use App\Enums\Payment;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\DataAwareRule;

class RequiredPaymentByAge implements ValidationRule, DataAwareRule
{
    // カスタムバリデーションルールが適用されているフィールド以外に、アクセスする際にこの変数定義が必要
    /**
     * @var array<string, mixed>
     */
    protected $data = [];

    public function __construct(private string $message)
    {
    }

    // カスタムバリデーションルールが適用されているフィールド以外に、アクセスする際にこのメソッド実装が必要
    /**
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $this->validatePaymentAmountByAge($value, $fail);
    }

    /**
     * 年齢による支払額をチェックする
     *
     * @param  mixed  $value
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     *
     * @return void
     */
    private function validatePaymentAmountByAge(mixed $value, Closure $fail): void
    {
        if ($this->isChild() && $value !== Payment::CHILD_PRICE->value) {
            $fail('12歳以下は子供料金のため、:attribute は'. Payment::CHILD_PRICE->value . '円でなければなりません。');
        }
        if (!$this->isChild() && $value !== Payment::ADULT_PRICE->value) {
            $fail('13歳以上は大人料金のため、:attribute は' . Payment::ADULT_PRICE->value . '円でなければなりません。');
        }
    }

    /**
     * 子供料金扱いかをチェックする
     *
     * @return bool
     */
    private function isChild(): bool
    {
        return $this->data['age'] < 13;
    }
}
