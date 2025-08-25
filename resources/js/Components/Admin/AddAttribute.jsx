import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';

const AddAttribute = () => {
    const [name, setName] = useState('');
    const [details, setDetails] = useState('');
    const [order, setOrder] = useState('');
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await axios.post('/api/attributes', { name, details, order });
            navigate('/attributes');
        } catch (error) {
            console.error('Error adding attribute:', error);
        }
    };

    return (
        <div className="container">
            <h1>Add New Attribute</h1>
            <form onSubmit={handleSubmit}>
                <div className="form-group">
                    <label htmlFor="name">Name</label>
                    <input type="text" id="name" className="form-control" value={name} onChange={(e) => setName(e.target.value)} required />
                </div>
                <div className="form-group">
                    <label htmlFor="details">Details</label>
                    <textarea id="details" className="form-control" value={details} onChange={(e) => setDetails(e.target.value)}></textarea>
                </div>
                <div className="form-group">
                    <label htmlFor="order">Order</label>
                    <input type="number" id="order" className="form-control" value={order} onChange={(e) => setOrder(e.target.value)} />
                </div>
                <button type="submit" className="btn btn-primary">Save</button>
            </form>
        </div>
    );
};

export default AddAttribute; 