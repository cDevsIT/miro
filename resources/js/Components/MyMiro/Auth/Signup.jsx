import React, { useState } from 'react';
import axios from 'axios';
import '../../../../css/mymiro.css'
import img1 from "../../../../../public/images/create-account.jpg";

const Signup = () => {
    const [formData, setFormData] = useState({
        name: '',
        profession: '',
        email: '',
        phone: '',
        password: '',
        password_confirmation: ''
    });
    const [error, setError] = useState('');
    const [loading, setLoading] = useState(false);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError('');
        setLoading(true);

        try {
            const response = await axios.post('/mymiro/signup', formData);
            if (response.data.message === 'Registration successful') {
                // Get return URL from query parameters
                const urlParams = new URLSearchParams(window.location.search);
                const returnUrl = urlParams.get('returnUrl');
                
                // Redirect to return URL if it exists, otherwise to MyMiro dashboard
                window.location.href = returnUrl || '/mymiro';
            }
        } catch (err) {
            setError(err.response?.data?.message || 'An error occurred');
        } finally {
            setLoading(false);
        }
    };

    // Get return URL for login link
    const getLoginUrl = () => {
        const urlParams = new URLSearchParams(window.location.search);
        const returnUrl = urlParams.get('returnUrl');
        return '/mymiro/login' + (returnUrl ? `?returnUrl=${returnUrl}` : '');
    };

    return (
        <section className="auth-section">
            <div className="container auth-container">
                <div className="auth-left">
                    <img src={img1} alt='Image For Create an Account of Miro' />
                </div>

                <div className="auth-right">
                    <div className="auth-form">
                        <h2>Create an account</h2>
                        <form onSubmit={handleSubmit}>
                            {error && <div className="error-message">{error}</div>}

                            <div className="form-group">
                                <label className="form-label">Name*</label>
                                <input
                                    type="text"
                                    value={formData.name}
                                    onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                                    required
                                />
                            </div>

                            <div className="form-group">
                                <label className="form-label">Profession*</label>
                                <select
                                    value={formData.profession}
                                    onChange={(e) => setFormData({ ...formData, profession: e.target.value })}
                                    required
                                >
                                    <option value="">Select Profession*</option>
                                    <option value="Architect">Architect</option>
                                    <option value="Lighting designer">Lighting designer</option>
                                    <option value="Electrical engineer">Electrical engineer</option>
                                    <option value="Electrical consultant">Electrical consultant</option>
                                    <option value="Product designer">Product designer</option>
                                    <option value="Client">Client</option>
                                </select>
                            </div>

                            <div className="form-group">
                                <label className="form-label">Email*</label>
                                <input
                                    type="email"
                                    value={formData.email}
                                    onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                                    required
                                />
                            </div>

                            <div className="form-group">
                                <label className="form-label">Phone Number*</label>
                                <input
                                    type="tel"
                                    value={formData.phone}
                                    onChange={(e) => setFormData({ ...formData, phone: e.target.value })}
                                    required
                                />
                            </div>

                            <div className="form-group">
                                <label className="form-label">Password*</label>
                                <input
                                    type="password"
                                    value={formData.password}
                                    onChange={(e) => setFormData({ ...formData, password: e.target.value })}
                                    required
                                />
                            </div>

                            <div className="form-group">
                                <label className="form-label">Confirm Password*</label>
                                <input
                                    type="password"
                                    value={formData.password_confirmation}
                                    onChange={(e) => setFormData({ ...formData, password_confirmation: e.target.value })}
                                    required
                                />
                            </div>

                            <button type="submit" className="signup-btn" disabled={loading}>
                                {loading ? 'Creating Account...' : 'Create Account'}
                            </button>

                            <p className="auth-switch">
                                Already have an account? <a href={getLoginUrl()}>Login here</a>
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    );
};

export default Signup; 