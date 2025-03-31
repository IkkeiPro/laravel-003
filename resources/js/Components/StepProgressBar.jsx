import React from 'react';

const StepProgressBar = ({ currentStep, totalSteps }) => {
    return (
        <div className="w-full py-6">
            <div className="w-full bg-gray-200 rounded-full h-2.5">
                <div
                    className="bg-[#cc6633] h-2.5 rounded-full transition-all duration-300 ease-in-out"
                    style={{ width: `${(currentStep / totalSteps) * 100}%` }}
                ></div>
            </div>
            <div className="flex justify-between mt-2">
                {Array.from({ length: totalSteps }, (_, i) => (
                    <div key={i} className="text-sm">
                        <span className={`font-medium ${currentStep > i ? 'text-[#cc6633]' : 'text-[#333333]'}`}>
                            Step {i + 1}
                        </span>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default StepProgressBar;
