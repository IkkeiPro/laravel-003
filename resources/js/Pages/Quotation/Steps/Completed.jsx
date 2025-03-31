import React from 'react';
import { Link } from '@inertiajs/react';

const Completed = () => {
    return (
        <div className="py-12 text-center">
            <div className="mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" className="h-24 w-24 mx-auto text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <h2 className="text-2xl font-bold text-[#333333] mb-4">
                お問い合わせありがとうございます！
            </h2>

            <p className="text-lg mb-6">
                ご入力いただいた内容に基づき、担当者より近日中にご連絡いたします。
            </p>

            <div className="max-w-md mx-auto bg-[#f8f6f2] p-6 rounded-lg mb-8">
                <p className="text-sm text-gray-600 mb-2">
                    ご不明な点がございましたら、下記までお問い合わせください。
                </p>
                <p className="font-medium">
                    TEL: 03-XXXX-XXXX（平日 9:00-18:00）
                </p>
                <p className="font-medium">
                    Email: info@example.com
                </p>
            </div>

            <Link
                href="/"
                className="inline-block px-6 py-3 bg-[#cc6633] text-white rounded-md hover:bg-opacity-90 transition-colors"
            >
                トップページに戻る
            </Link>
        </div>
    );
};

export default Completed;
