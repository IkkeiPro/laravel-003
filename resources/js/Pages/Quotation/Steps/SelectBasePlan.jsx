import React, { useState, useEffect } from 'react';
import axios from 'axios';

const SelectBasePlan = ({ quotationData, updateQuotationData, nextStep }) => {
    const [basePlans, setBasePlans] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchBasePlans = async () => {
            try {
                const response = await axios.get('/api/base-plans');
                setBasePlans(response.data);
                setLoading(false);
            } catch (err) {
                setError('ベースプランの取得に失敗しました。');
                setLoading(false);
            }
        };

        fetchBasePlans();
    }, []);

    const handleSelectPlan = (plan) => {
        updateQuotationData({ selectedPlan: plan });
    };

    const handleContinue = () => {
        if (quotationData.selectedPlan) {
            nextStep();
        }
    };

    if (loading) return <div className="text-center py-6">読み込み中...</div>;
    if (error) return <div className="text-red-500 text-center py-6">{error}</div>;

    return (
        <div className="py-6">
            <h2 className="text-xl font-semibold text-[#333333] mb-4">ベースプランを選択</h2>
            <p className="mb-6 text-gray-600">まずは基本となるプランを選びましょう。</p>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {basePlans.map((plan) => (
                    <div
                        key={plan.id}
                        className={`border rounded-lg overflow-hidden cursor-pointer transition-all duration-200 hover:shadow-lg ${
                            quotationData.selectedPlan?.id === plan.id
                                ? 'border-[#cc6633] ring-2 ring-[#cc6633]'
                                : 'border-gray-200'
                        }`}
                        onClick={() => handleSelectPlan(plan)}
                    >
                        <div className="relative">
                            {plan.image_url_1f && (
                                <img
                                    src={plan.image_url_1f}
                                    alt={`${plan.name} 1階平面図`}
                                    className="w-full h-48 object-cover"
                                />
                            )}
                            {!plan.image_url_1f && (
                                <div className="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <span className="text-gray-500">イメージ準備中</span>
                                </div>
                            )}
                        </div>
                        <div className="p-4">
                            <h3 className="text-lg font-medium text-[#333333]">{plan.name}</h3>
                            <p className="text-sm text-gray-500 mt-1">
                                床面積: {plan.floor_area_1f}㎡ (1階)
                                {plan.floor_area_2f ? ` + ${plan.floor_area_2f}㎡ (2階)` : ''}
                            </p>
                            <p className="text-lg font-bold text-[#cc6633] mt-2">
                                {plan.price_standard}万円〜
                            </p>
                            {plan.comment && (
                                <p className="text-sm text-gray-600 mt-2">{plan.comment}</p>
                            )}
                        </div>
                    </div>
                ))}
            </div>

            <div className="mt-8 flex justify-end">
                <button
                    onClick={handleContinue}
                    disabled={!quotationData.selectedPlan}
                    className="px-6 py-2 bg-[#cc6633] text-white rounded-md hover:bg-opacity-90 disabled:bg-gray-300 disabled:cursor-not-allowed"
                >
                    次へ進む
                </button>
            </div>
        </div>
    );
};

export default SelectBasePlan;
