// resources/js/Pages/Quotation/Steps/QuotationResult.jsx
import React, { useState } from 'react';
import axios from 'axios';

const QuotationResult = ({ quotationData, updateQuotationData, nextStep, prevStep }) => {
    const [submitting, setSubmitting] = useState(false);
    const [errors, setErrors] = useState({});

    const handleInputChange = (e) => {
        const { name, value, type, checked } = e.target;
        const inputValue = type === 'checkbox' ? checked : value;

        updateQuotationData({
            userInfo: {
                ...quotationData.userInfo,
                [name]: inputValue
            }
        });
    };

    const validateForm = () => {
        const newErrors = {};
        const requiredFields = [
            'last_name', 'first_name', 'last_name_kana', 'first_name_kana',
            'phone_number', 'email', 'zip_code', 'address1', 'address2'
        ];

        requiredFields.forEach(field => {
            if (!quotationData.userInfo[field]) {
                newErrors[field] = '入力必須項目です';
            }
        });

        // メールアドレスバリデーション
        if (quotationData.userInfo.email && !/\S+@\S+\.\S+/.test(quotationData.userInfo.email)) {
            newErrors.email = '有効なメールアドレスを入力してください';
        }

        // 電話番号バリデーション（ハイフン任意）
        if (quotationData.userInfo.phone_number &&
            !/^[0-9\-]{10,15}$/.test(quotationData.userInfo.phone_number)) {
            newErrors.phone_number = '有効な電話番号を入力してください';
        }

        // 郵便番号バリデーション（ハイフン任意）
        if (quotationData.userInfo.zip_code &&
            !/^[0-9\-]{7,8}$/.test(quotationData.userInfo.zip_code)) {
            newErrors.zip_code = '有効な郵便番号を入力してください';
        }

        setErrors(newErrors);
        return Object.keys(newErrors).length === 0;
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        if (!validateForm()) {
            return;
        }

        setSubmitting(true);

        try {
            // API送信データの準備
            const formData = {
                ...quotationData.userInfo,
                selected_plan_id: quotationData.selectedPlan.id,
                total_price: quotationData.totalPrice
            };

            // APIにデータ送信
            await axios.post('/api/consultation-users', formData);

            // 送信成功したら次のステップ（完了画面）へ
            nextStep();
        } catch (error) {
            console.error('送信エラー:', error);
            setErrors({
                submission: '送信中にエラーが発生しました。もう一度お試しください。'
            });
        } finally {
            setSubmitting(false);
        }
    };

    // 見積もり合計金額を表示用にフォーマット
    const formattedTotalPrice = new Intl.NumberFormat('ja-JP').format(quotationData.totalPrice);

    return (
        <div className="py-6">
            <h2 className="text-xl font-semibold text-[#333333] mb-4">見積結果とお客様情報</h2>

            <div className="mb-8 p-6 bg-[#f8f6f2] rounded-lg">
                <h3 className="text-lg font-medium mb-4">見積概要</h3>

                <div className="mb-4">
                    <p className="font-medium">選択プラン:</p>
                    <p className="text-lg">{quotationData.selectedPlan?.name}</p>
                </div>

                <div className="mb-4">
                    <p className="font-medium">選択オプション:</p>
                    <ul className="list-disc list-inside ml-4 mt-2">
                        {[...quotationData.exteriorOptions, ...quotationData.interiorOptions, ...quotationData.equipmentOptions].map((option) => (
                            <li key={option.id} className="text-sm">
                                {option.name} ({option.price.toLocaleString()}円)
                            </li>
                        ))}
                        {[...quotationData.exteriorOptions, ...quotationData.interiorOptions, ...quotationData.equipmentOptions].length === 0 && (
                            <li className="text-sm">追加オプションなし</li>
                        )}
                    </ul>
                </div>

                <div className="mt-6 pt-4 border-t border-gray-300">
                    <div className="flex justify-between items-center">
                        <p className="text-lg font-bold">合計金額:</p>
                        <p className="text-2xl font-bold text-[#cc6633]">{formattedTotalPrice}円</p>
                    </div>
                    <p className="text-sm text-gray-500 mt-1">※ 税込価格です。別途諸経費がかかる場合があります。</p>
                </div>
            </div>

            <form onSubmit={handleSubmit}>
                <h3 className="text-lg font-medium mb-4">お客様情報入力</h3>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            姓 <span className="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="last_name"
                            value={quotationData.userInfo.last_name}
                            onChange={handleInputChange}
                            className={`w-full px-3 py-2 border rounded-md ${errors.last_name ? 'border-red-500' : 'border-gray-300'}`}
                        />
                        {errors.last_name && <p className="text-red-500 text-xs mt-1">{errors.last_name}</p>}
                    </div>

                    <div>
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            名 <span className="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="first_name"
                            value={quotationData.userInfo.first_name}
                            onChange={handleInputChange}
                            className={`w-full px-3 py-2 border rounded-md ${errors.first_name ? 'border-red-500' : 'border-gray-300'}`}
                        />
                        {errors.first_name && <p className="text-red-500 text-xs mt-1">{errors.first_name}</p>}
                    </div>

                    <div>
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            姓（カナ） <span className="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="last_name_kana"
                            value={quotationData.userInfo.last_name_kana}
                            onChange={handleInputChange}
                            className={`w-full px-3 py-2 border rounded-md ${errors.last_name_kana ? 'border-red-500' : 'border-gray-300'}`}
                        />
                        {errors.last_name_kana && <p className="text-red-500 text-xs mt-1">{errors.last_name_kana}</p>}
                    </div>

                    <div>
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            名（カナ） <span className="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="first_name_kana"
                            value={quotationData.userInfo.first_name_kana}
                            onChange={handleInputChange}
                            className={`w-full px-3 py-2 border rounded-md ${errors.first_name_kana ? 'border-red-500' : 'border-gray-300'}`}
                        />
                        {errors.first_name_kana && <p className="text-red-500 text-xs mt-1">{errors.first_name_kana}</p>}
                    </div>
                </div>

                <div className="mb-4">
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        電話番号 <span className="text-red-500">*</span>
                    </label>
                    <input
                        type="tel"
                        name="phone_number"
                        value={quotationData.userInfo.phone_number}
                        onChange={handleInputChange}
                        className={`w-full px-3 py-2 border rounded-md ${errors.phone_number ? 'border-red-500' : 'border-gray-300'}`}
                        placeholder="例: 090-1234-5678"
                    />
                    {errors.phone_number && <p className="text-red-500 text-xs mt-1">{errors.phone_number}</p>}
                </div>

                <div className="mb-4">
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        メールアドレス <span className="text-red-500">*</span>
                    </label>
                    <input
                        type="email"
                        name="email"
                        value={quotationData.userInfo.email}
                        onChange={handleInputChange}
                        className={`w-full px-3 py-2 border rounded-md ${errors.email ? 'border-red-500' : 'border-gray-300'}`}
                        placeholder="例: example@example.com"
                    />
                    {errors.email && <p className="text-red-500 text-xs mt-1">{errors.email}</p>}
                </div>

                <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            郵便番号 <span className="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="zip_code"
                            value={quotationData.userInfo.zip_code}
                            onChange={handleInputChange}
                            className={`w-full px-3 py-2 border rounded-md ${errors.zip_code ? 'border-red-500' : 'border-gray-300'}`}
                            placeholder="例: 123-4567"
                        />
                        {errors.zip_code && <p className="text-red-500 text-xs mt-1">{errors.zip_code}</p>}
                    </div>

                    <div className="md:col-span-2">
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            都道府県 <span className="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="address1"
                            value={quotationData.userInfo.address1}
                            onChange={handleInputChange}
                            className={`w-full px-3 py-2 border rounded-md ${errors.address1 ? 'border-red-500' : 'border-gray-300'}`}
                            placeholder="例: 東京都"
                        />
                        {errors.address1 && <p className="text-red-500 text-xs mt-1">{errors.address1}</p>}
                    </div>
                </div>

                <div className="mb-4">
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        市区町村・番地 <span className="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="address2"
                        value={quotationData.userInfo.address2}
                        onChange={handleInputChange}
                        className={`w-full px-3 py-2 border rounded-md ${errors.address2 ? 'border-red-500' : 'border-gray-300'}`}
                        placeholder="例: 渋谷区渋谷1-2-3"
                    />
                    {errors.address2 && <p className="text-red-500 text-xs mt-1">{errors.address2}</p>}
                </div>

                <div className="mb-6">
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        建物名・部屋番号
                    </label>
                    <input
                        type="text"
                        name="address3"
                        value={quotationData.userInfo.address3}
                        onChange={handleInputChange}
                        className="w-full px-3 py-2 border border-gray-300 rounded-md"
                        placeholder="例: ○○マンション101号室"
                    />
                </div>

                <div className="mb-4">
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        希望連絡方法 <span className="text-red-500">*</span>
                    </label>
                    <div className="flex space-x-4">
                        <label className="inline-flex items-center">
                            <input
                                type="radio"
                                name="contact_method"
                                value="email"
                                checked={quotationData.userInfo.contact_method === 'email'}
                                onChange={handleInputChange}
                                className="mr-2"
                            />
                            メール
                        </label>
                        <label className="inline-flex items-center">
                            <input
                                type="radio"
                                name="contact_method"
                                value="phone"
                                checked={quotationData.userInfo.contact_method === 'phone'}
                                onChange={handleInputChange}
                                className="mr-2"
                            />
                            電話
                        </label>
                    </div>
                </div>

                <div className="mb-4">
                    <label className="block text-sm font-medium text-gray-700 mb-1">
                        建築予定時期 <span className="text-red-500">*</span>
                    </label>
                    <div className="flex space-x-4">
                        <label className="inline-flex items-center">
                            <input
                                type="radio"
                                name="build_schedule"
                                value="within_1_year"
                                checked={quotationData.userInfo.build_schedule === 'within_1_year'}
                                onChange={handleInputChange}
                                className="mr-2"
                            />
                            1年以内
                        </label>
                        <label className="inline-flex items-center">
                            <input
                                type="radio"
                                name="build_schedule"
                                value="after_1_year"
                                checked={quotationData.userInfo.build_schedule === 'after_1_year'}
                                onChange={handleInputChange}
                                className="mr-2"
                            />
                            1年以降
                        </label>
                    </div>
                </div>

                <div className="mb-6">
                    <label className="inline-flex items-center">
                        <input
                            type="checkbox"
                            name="has_build_location"
                            checked={quotationData.userInfo.has_build_location}
                            onChange={handleInputChange}
                            className="mr-2"
                        />
                        <span className="text-sm">建築予定地はすでにお持ちですか？</span>
                    </label>
                </div>

                {errors.submission && (
                    <div className="mb-4 p-3 bg-red-100 text-red-700 rounded-md">
                        {errors.submission}
                    </div>
                )}

                <div className="mt-8 flex justify-between">
                    <button
                        type="button"
                        onClick={prevStep}
                        className="px-6 py-2 bg-gray-200 text-[#333333] rounded-md hover:bg-gray-300"
                    >
                        戻る
                    </button>
                    <button
                        type="submit"
                        disabled={submitting}
                        className="px-6 py-2 bg-[#cc6633] text-white rounded-md hover:bg-opacity-90 disabled:bg-opacity-70 disabled:cursor-not-allowed"
                    >
                        {submitting ? '送信中...' : '見積を送信する'}
                    </button>
                </div>
            </form>
        </div>
    );
};

export default QuotationResult;
