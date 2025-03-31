import React, { useState, useEffect } from 'react';
import { Head } from '@inertiajs/react';
import StepProgressBar from '@/Components/StepProgressBar';
import SelectBasePlan from './Steps/SelectBasePlan';
import SelectExterior from './Steps/SelectExterior';
import SelectInterior from './Steps/SelectInterior';
import SelectEquipment from './Steps/SelectEquipment';
import QuotationResult from './Steps/QuotationResult';
import Completed from './Steps/Completed';

const QuotationIndex = () => {
    const [currentStep, setCurrentStep] = useState(1);
    const [quotationData, setQuotationData] = useState({
        selectedPlan: null,
        exteriorOptions: [],
        interiorOptions: [],
        equipmentOptions: [],
        userInfo: {
            last_name: '',
            first_name: '',
            last_name_kana: '',
            first_name_kana: '',
            phone_number: '',
            email: '',
            zip_code: '',
            address1: '',
            address2: '',
            address3: '',
            contact_method: 'email',
            build_schedule: 'within_1_year',
            has_build_location: false
        },
        totalPrice: 0
    });

    const nextStep = () => {
        setCurrentStep(prev => Math.min(prev + 1, 6));
    };

    const prevStep = () => {
        setCurrentStep(prev => Math.max(prev - 1, 1));
    };

    const updateQuotationData = (data) => {
        setQuotationData(prev => ({ ...prev, ...data }));
    };

    const calculateTotalPrice = () => {
        if (!quotationData.selectedPlan) return 0;

        // ベースプランの価格（万円を円に変換）
        let total = quotationData.selectedPlan.price_standard * 10000;

        // 選択された仕様オプションの価格を追加
        const allOptions = [
            ...quotationData.exteriorOptions,
            ...quotationData.interiorOptions,
            ...quotationData.equipmentOptions
        ];

        allOptions.forEach(option => {
            total += option.price;
        });

        return total;
    };

    useEffect(() => {
        const total = calculateTotalPrice();
        setQuotationData(prev => ({ ...prev, totalPrice: total }));
    }, [
        quotationData.selectedPlan,
        quotationData.exteriorOptions,
        quotationData.interiorOptions,
        quotationData.equipmentOptions
    ]);

    const renderStep = () => {
        switch (currentStep) {
            case 1:
                return (
                    <SelectBasePlan
                        quotationData={quotationData}
                        updateQuotationData={updateQuotationData}
                        nextStep={nextStep}
                    />
                );
            case 2:
                return (
                    <SelectExterior
                        quotationData={quotationData}
                        updateQuotationData={updateQuotationData}
                        nextStep={nextStep}
                        prevStep={prevStep}
                    />
                );
            case 3:
                return (
                    <SelectInterior
                        quotationData={quotationData}
                        updateQuotationData={updateQuotationData}
                        nextStep={nextStep}
                        prevStep={prevStep}
                    />
                );
            case 4:
                return (
                    <SelectEquipment
                        quotationData={quotationData}
                        updateQuotationData={updateQuotationData}
                        nextStep={nextStep}
                        prevStep={prevStep}
                    />
                );
            case 5:
                return (
                    <QuotationResult
                        quotationData={quotationData}
                        updateQuotationData={updateQuotationData}
                        nextStep={nextStep}
                        prevStep={prevStep}
                    />
                );
            case 6:
                return <Completed />;
            default:
                return null;
        }
    };

    return (
        <>
            <Head title="住宅プラン見積" />
            <div className="py-12 bg-[#f8f6f2]">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h1 className="text-2xl font-bold text-[#333333] mb-6 text-center">
                            オリジナル住宅プラン見積
                        </h1>
                        {currentStep < 6 && (
                            <StepProgressBar currentStep={currentStep} totalSteps={5} />
                        )}
                        {renderStep()}
                    </div>
                </div>
            </div>
        </>
    );
};

export default QuotationIndex;
