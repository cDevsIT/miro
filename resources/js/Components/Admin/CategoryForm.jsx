import React, { useState } from 'react';
import axios from 'axios';

const CategoryForm = ({ category = null, onSuccess }) => {
    const [formData, setFormData] = useState({
        name: category?.name || '',
        details: category?.details || '',
        type: category?.type || 'indoor',
        order: category?.order || 0,
        thumbnail: null,
        banner: null
    });

    const [errors, setErrors] = useState({});
    const [loading, setLoading] = useState(false);

    const typeOptions = [
        { value: 'indoor', label: 'Indoor Product' },
        { value: 'outdoor', label: 'Outdoor Product' }
    ];

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setErrors({});

        const data = new FormData();
        Object.keys(formData).forEach(key => {
            if (formData[key] !== null) {
                data.append(key, formData[key]);
            }
        });

        try {
            const url = category 
                ? `/admin/products/categories/${category.id}`
                : '/admin/products/categories';
            
            if (category) {
                data.append('_method', 'PUT');
            }

            await axios.post(url, data);
            onSuccess?.();
        } catch (error) {
            setErrors(error.response?.data?.errors || {});
        } finally {
            setLoading(false);
        }
    };

    return (
        <form onSubmit={handleSubmit} className="space-y-6">
            <div>
                <label className="block text-sm font-medium text-gray-700">Name</label>
                <input
                    type="text"
                    value={formData.name}
                    onChange={e => setFormData({...formData, name: e.target.value})}
                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                />
                {errors.name && <p className="mt-1 text-sm text-red-600">{errors.name[0]}</p>}
            </div>

            <div>
                <label className="block text-sm font-medium text-gray-700">Category Type</label>
                <select
                    value={formData.type}
                    onChange={e => setFormData({...formData, type: e.target.value})}
                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                >
                    {typeOptions.map(option => (
                        <option key={option.value} value={option.value}>
                            {option.label}
                        </option>
                    ))}
                </select>
                {errors.type && <p className="mt-1 text-sm text-red-600">{errors.type[0]}</p>}
            </div>

            <div>
                <label className="block text-sm font-medium text-gray-700">Details</label>
                <textarea
                    value={formData.details}
                    onChange={e => setFormData({...formData, details: e.target.value})}
                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    rows="4"
                />
                {errors.details && <p className="mt-1 text-sm text-red-600">{errors.details[0]}</p>}
            </div>

            <div>
                <label className="block text-sm font-medium text-gray-700">Order</label>
                <input
                    type="number"
                    value={formData.order}
                    onChange={e => setFormData({...formData, order: e.target.value})}
                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                />
                {errors.order && <p className="mt-1 text-sm text-red-600">{errors.order[0]}</p>}
            </div>

            <div>
                <label className="block text-sm font-medium text-gray-700">Thumbnail</label>
                <input
                    type="file"
                    onChange={e => setFormData({...formData, thumbnail: e.target.files[0]})}
                    className="mt-1 block w-full"
                    accept="image/*"
                />
                {errors.thumbnail && <p className="mt-1 text-sm text-red-600">{errors.thumbnail[0]}</p>}
            </div>

            <div>
                <label className="block text-sm font-medium text-gray-700">Banner</label>
                <input
                    type="file"
                    onChange={e => setFormData({...formData, banner: e.target.files[0]})}
                    className="mt-1 block w-full"
                    accept="image/*"
                />
                {errors.banner && <p className="mt-1 text-sm text-red-600">{errors.banner[0]}</p>}
            </div>

            <button
                type="submit"
                disabled={loading}
                className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
            >
                {loading ? 'Saving...' : (category ? 'Update' : 'Create')}
            </button>
        </form>
    );
};

export default CategoryForm; 