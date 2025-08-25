import React, { useState, useEffect } from 'react';
import axios from 'axios';

const Login = () => {
    const [formData, setFormData] = useState({
        email: '',
        password: ''
    });

    useEffect(() => {
        const checkAuthStatus = async () => {
            try {
                const response = await axios.get('/api/check-auth'); // Ensure this endpoint is correct
                if (response.data.isAuthenticated) {
                    window.location.href = '/dashboard'; // Redirect if authenticated
                }
            } catch (error) {
                console.error('Error checking auth status:', error);
            }
        };

        checkAuthStatus();
    }, []);

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const response = await axios.post('/login', formData, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            window.location.href = '/dashboard'; // Redirect on successful login
        } catch (error) {
            console.error('Login error:', error);
        }
    };

    return (
        <div className="admin-login-container">
            <div className="login-left">
                <div className="login-image">
                    {/* <img src="/images/miro-login-bg.jpg" alt="Login Background" /> */}
                    <div className="image-overlay"></div>
                </div>
                <div className="login-left-content">
                    <h2>Welcome to Miro Admin</h2>
                    <p>Manage your products, orders, and customer interactions all in one place.</p>
                </div>
            </div>

            <div className="login-right">
                <div className="login-form-container">
                    <div className="login-header">
                        <img src="/images/miro-logo.png" alt="Miro" />
                        <h1>Sign in to Admin Panel</h1>
                        <p>Enter your credentials to access your account</p>
                    </div>

                    <form onSubmit={handleSubmit} className="login-form">
                        <div className="form-group">
                            <label htmlFor="email">Email</label>
                                <input 
                                    type="email" 
                                    id="email"
                                    name="email" 
                                    value={formData.email}
                                    onChange={(e) => setFormData({...formData, email: e.target.value})}
                                    placeholder="Enter your email"
                                    required 
                                />
                           
                        </div>

                        <div className="form-group">
                            <label htmlFor="password">Password</label>
                                <input 
                                    type="password" 
                                    id="password"
                                    name="password" 
                                    value={formData.password}
                                    onChange={(e) => setFormData({...formData, password: e.target.value})}
                                    placeholder="Enter your password"
                                    required
                                />
                        </div>
{/* 
                        <div className="form-group remember-forgot">
                            <label className="remember-me">
                                <input type="checkbox" name="remember" />
                                <span>Remember me</span>
                            </label>
                            <a href="/password/reset" className="forgot-password">Forgot password?</a>
                        </div> */}

                        <button type="submit" className="login-button">
                            Sign In
                        </button>
                    </form>
                </div>
            </div>
        </div>
    );
};

export default Login; 