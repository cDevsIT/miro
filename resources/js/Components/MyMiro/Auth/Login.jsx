import React, { useState } from 'react';
import axios from 'axios';
import '../../../../css/mymiro.css'

const Login = () => {
    const [formData, setFormData] = useState({
        email: '',
        password: ''
    });
    const [error, setError] = useState('');
    const [loading, setLoading] = useState(false);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError('');
        setLoading(true);

        try {
            const response = await axios.post('/mymiro/login', formData);
            if (response.data.message === 'Login successful') {
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

    return (
        <section className="auth-section">
            <div className="container auth-container">
                <div className="auth-left">
                    <h1>myMiro: Your Personalized Lighting Management Tool</h1>
                    <p>With myMiro, you can effortlessly save and manage your own Miro product selections. By creating a myMiro user account, you unlock a range of powerful features designed to enhance your lighting experience.</p>
                    <button 
                        onClick={() => {
                            const urlParams = new URLSearchParams(window.location.search);
                            const returnUrl = urlParams.get('returnUrl');
                            const signupUrl = '/mymiro/signup' + (returnUrl ? `?returnUrl=${returnUrl}` : '');
                            window.location.href = signupUrl;
                        }} 
                        className="create-account-btn"
                    >
                        Create an account
                    </button>
                </div>

                <div className="auth-right">
                    <div className="auth-form ligin-form">
                        <h2>Login</h2>
                        <form onSubmit={handleSubmit}>
                            {error && <div className="error-message">{error}</div>}
                            <div className="form-group">
                                <input 
                                    type="email" 
                                    placeholder="Email"
                                    value={formData.email}
                                    onChange={(e) => setFormData({...formData, email: e.target.value})}
                                    required
                                />
                            </div>
                            <div className="form-group">
                                <input 
                                    type="password" 
                                    placeholder="Password"
                                    value={formData.password}
                                    onChange={(e) => setFormData({...formData, password: e.target.value})}
                                    autoComplete="off"
                                    required
                                />
                                <a href="/mymiro/forgot-password" className="forgot-password">Forgot Password?</a>
                            </div>
                            
                            <button type="submit" className="login-btn" disabled={loading}>
                                {loading ? 'Logging in...' : 'Log in'}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default Login; 