import React, { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import axios from 'axios';

const EditAttribute = () => {
    const { id } = useParams();
    const [name, setName] = useState('');
    const [details, setDetails] = useState('');
    const [order, setOrder] = useState('');
    const navigate = useNavigate();

    useEffect(() => {
        fetchAttribute();
    }, []);

    const fetchAttribute = async () => {
        try {
            const response = await axios.get(`/api/attributes/${id}`);
            const { name, details, order } = response.data;
            setName(name);
            setDetails(details);
            setOrder(order);
        } catch (error) {
            console.error('Error fetching attribute:', error);
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await axios.put(`/api/attributes/${id}`, { name, details, order });
            history.push('/attributes');
        } catch (error) {
            console.error('Error updating attribute:', error);
        }
    };

    return (
        <div className="container">
            <h1>Edit Attribute</h1>
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
                <button type="submit" className="btn btn-primary">Update</button>
            </form>
        </div>
    );
};

export default EditAttribute; 