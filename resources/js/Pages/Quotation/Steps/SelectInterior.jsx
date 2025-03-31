// resources/js/Pages/Quotation/Steps/SelectInterior.jsx
import React, { useState, useEffect } from 'react';
import axios from 'axios';

const SelectInterior = ({ quotationData, updateQuotationData, nextStep, prevStep }) => {
    const [interiorOptions, setInteriorOptions] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchInteriorOptions = async () => {
            try {
                if (!quotationData.selectedPlan) {
                    throw new Error('ベースプランが選択されていません');
                }

                // プランに関連付けられた内装仕様を取得
                const response = await axios.get(`/api/base-plans/${quotationData.selectedPlan.id}/specifications`);

                // 内装カテゴリのみをフィルタリング
                const interiorSpecs = response.data.filter(item => item.category === 'interior');

                // 仕様の詳細データを設定
                setInteriorOptions(interiorSpecs);
                setLoading(false);
            } catch (err) {
                setError('内装オプションの取得に失敗しました。');
                setLoading(false);
            }
        };

        fetchInteriorOptions();
    }, [quotationData.selectedPlan]);

    const handleOptionChange = (specificationId, optionId, isChecked) => {
        const updatedOptions = [...quotationData.interiorOptions];

        if (isChecked) {
            // オプションを追加
            const specItem = interiorOptions.find(spec => spec.specification.id === specificationId);
            if (specItem) {
                const option = specItem.specification.specificationsMeisai.find(item => item.id === optionId);
                if (option) {
                    updatedOptions.push(option);
                }
            }
        } else {
            // オプションを削除
            const index = updatedOptions.findIndex(option => option.id === optionId);
            if (index !== -1) {
                updatedOptions.splice(index, 1);
            }
        }

        updateQuotationData({ interiorOptions: updatedOptions });
    };

    const isOptionSelected = (optionId) => {
        return quotationData.interiorOptions.some(option => option.id === optionId);
    };

    if (loading) return <div className="text-center py-6">読み込み中...</div>;
    if (error) return <div className="text-red-500 text-center py-6">{error}</div>;

    return (
        <div className="py-6">
            <h2 className="text-xl font-semibold text-[#333333] mb-4">内装仕様を選択</h2>
            <p className="mb-6 text-gray-600">お好みの内装仕様をお選びください。</p>

            {interiorOptions.length === 0 ? (
                <p className="text-center py-4">このプランには内装オプションがありません。</p>
            ) : (
                interiorOptions.map(item => (
                    <div key={item.specification.id} className="mb-8 border-b pb-6">
                        <h3 className="text-lg font-medium mb-2">{item.specification.title}</h3>
                        <p className="text-sm text-gray-600 mb-4">{item.specification.description}</p>

                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            {item.specification.specificationsMeisai.map(option => (
                                <div
                                    key={option.id}
                                    className={`border rounded-lg p-4 ${
                                        isOptionSelected(option.id)
                                            ? 'border-[#cc6633] bg-[#f8f6f2]'
                                            : 'border-gray-200'
                                    }`}
                                >
                                    <div className="flex items-start">
                                        <input
                                            type="checkbox"
                                            id={`option-${option.id}`}
                                            checked={isOptionSelected(option.id)}
                                            onChange={(e) => handleOptionChange(
                                                item.specification.id,
                                                option.id,
                                                e.target.checked
                                            )}
                                            className="mt-1 mr-3"
                                        />
                                        <div>
                                            <label
                                                htmlFor={`option-${option.id}`}
                                                className="font-medium cursor-pointer"
                                            >
                                                {option.name}
                                            </label>
                                            <p className="text-[#cc6633] font-medium mt-1">
                                                {option.price.toLocaleString()}円
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                ))
            )}

            <div className="mt-8 flex justify-between">
                <button
                    onClick={prevStep}
                    className="px-6 py-2 bg-gray-200 text-[#333333] rounded-md hover:bg-gray-300"
                >
                    戻る
                </button>
                <button
                    onClick={nextStep}
                    className="px-6 py-2 bg-[#cc6633] text-white rounded-md hover:bg-opacity-90"
                >
                    次へ進む
                </button>
            </div>
        </div>
    );
};

export default SelectInterior;
