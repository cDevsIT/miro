import React, { useState, useEffect } from 'react';
import axios from 'axios';

const Login = () => {
    const [formData, setFormData] = useState({
        email: '',
        password: ''
    });
    const [errors, setErrors] = useState({});
    const [isLoading, setIsLoading] = useState(false);

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
        setErrors({});
        setIsLoading(true);
        
        try {
            const response = await axios.post('/login', formData, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                withCredentials: true
            });
            
            // Check if login was successful
            // Laravel might return 200 with redirect HTML or JSON
            if (response.status === 200) {
                // If we get a success response, redirect
                if (response.data && response.data.success) {
                    window.location.href = response.data.redirect || '/admin/dashboard';
                } else {
                    // Even without explicit success flag, a 200 response means login worked
                    // The server might have done the redirect already
                    window.location.href = '/admin/dashboard';
                }
            } else {
                // Unexpected response format
                setIsLoading(false);
                setErrors({
                    email: ['Unexpected response from server. Please try again.']
                });
            }
        } catch (error) {
            setIsLoading(false);
            
            console.error('Login error:', error);
            console.error('Error response:', error.response);
            
            if (error.response) {
                // Handle validation errors
                if (error.response.status === 422) {
                    const validationErrors = error.response.data.errors || {};
                    setErrors(validationErrors);
                } else if (error.response.status === 302) {
                    // Handle redirect response - shouldn't happen with JSON request
                    window.location.href = '/admin/dashboard';
                } else if (error.response.data && error.response.data.errors) {
                    // Server returned errors in JSON
                    setErrors(error.response.data.errors);
                } else {
                    // Generic error
                    setErrors({
                        email: ['The provided credentials do not match our records.']
                    });
                }
            } else if (error.request) {
                // Request was made but no response
                setErrors({
                    email: ['No response from server. Please check your connection.']
                });
            } else {
                // Something else went wrong
                setErrors({
                    email: ['An error occurred. Please try again.']
                });
            }
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
                        {/* Error Message before email field */}
                        {(errors.email || errors.password) && (
                            <div className="alert alert-danger" role="alert">
                                <i className="fas fa-exclamation-circle"></i>
                                <span>{errors.email ? errors.email[0] : errors.password[0]}</span>
                            </div>
                        )}

                        <div className="form-group">
                            <label htmlFor="email">Email</label>
                            <input 
                                type="email" 
                                id="email"
                                name="email" 
                                value={formData.email}
                                onChange={(e) => {
                                    setFormData({...formData, email: e.target.value});
                                    setErrors({});
                                }}
                                placeholder="Enter your email"
                                className={errors.email ? 'error' : ''}
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
                                onChange={(e) => {
                                    setFormData({...formData, password: e.target.value});
                                    setErrors({});
                                }}
                                placeholder="Enter your password"
                                className={errors.password ? 'error' : ''}
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

                        <button type="submit" className="login-button" disabled={isLoading}>
                            {isLoading ? (
                                <>
                                    <i className="fas fa-spinner fa-spin"></i> Signing In...
                                </>
                            ) : (
                                'Sign In'
                            )}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    );
};

export default Login; 