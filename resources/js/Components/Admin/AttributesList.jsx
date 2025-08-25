import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

const AttributesList = () => {
    const [attributes, setAttributes] = useState([]);

    useEffect(() => {
        fetchAttributes();
    }, []);

    const fetchAttributes = async () => {
        try {
            const response = await axios.get('/api/attributes');
            console.log('Fetched attributes:', response.data);
            setAttributes(response.data);
        } catch (error) {
            console.error('Error fetching attributes:', error);
        }
    };

    const deleteAttribute = async (id) => {
        try {
            await axios.delete(`/api/attributes/${id}`);
            fetchAttributes();
        } catch (error) {
            console.error('Error deleting attribute:', error);
        }
    };

    return (
        <div className="container">
            <h1>Attributes</h1>
            <Link to="/attributes/create" className="btn btn-primary">Add New Attribute</Link> {/* Ensure this path is correct */}
            <table className="table mt-3">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {attributes.map(attribute => (
                        <tr key={attribute.id}>
                            <td>{attribute.name}</td>
                            <td>{attribute.details}</td>
                            <td>{attribute.order}</td>
                            <td>
                                <Link to={`/attributes/edit/${attribute.id}`} className="btn btn-warning">Edit</Link>
                                <button onClick={() => deleteAttribute(attribute.id)} className="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default AttributesList;