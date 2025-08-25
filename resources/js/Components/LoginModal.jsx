import React, { useEffect, useRef, useState } from 'react';
import axios from 'axios';
import Mail from "../../../public/images/icons/EMAIL.svg";
import LOCK from "../../../public/images/icons/LOCK.svg";
import '../../css/LoginModal.css';

const LoginModal = ({ show, onClose }) => {
    const modalRef = useRef(null);
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        const handleClickOutside = (event) => {
            if (modalRef.current && !modalRef.current.contains(event.target)) {
                onClose();
            }
        };

        const handleEscape = (event) => {
            if (event.key === 'Escape') {
                onClose();
            }
        };

        if (show) {
            document.addEventListener('mousedown', handleClickOutside);
            document.addEventListener('keydown', handleEscape);
            document.body.style.overflow = 'hidden';
        }

        return () => {
            document.removeEventListener('mousedown', handleClickOutside);
            document.removeEventListener('keydown', handleEscape);
            document.body.style.overflow = 'unset';
        };
    }, [show, onClose]);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError('');
        setLoading(true);

        try {
            const response = await axios.post('/mymiro/login', { email, password });
            if (response.data.message === 'Login successful') {
                // Close the modal on successful login
                onClose();
                // Optionally refresh the page or update the UI state
                window.location.reload();
            }
        } catch (err) {
            setError(err.response?.data?.message || 'An error occurred during login');
        } finally {
            setLoading(false);
        }
    };

    if (!show) return null;

    return (
        <div className="login-modal-overlay">
            <div ref={modalRef} className="login-modal-content">
                {/* Header */}
                <div className="login-modal-header">
                    <h2>Login to myMiro</h2>
                    {/* <button onClick={onClose} className="login-modal-close-button">
                        <X className="login-modal-close-icon" />
                        X
                    </button> */}
                </div>

                {/* Form */}
                <form onSubmit={handleSubmit} className="login-modal-form">
                    {error && <div className="login-modal-error">{error}</div>}
                    <div className="login-modal-input-group">
                        <div className="login-modal-input-wrapper">
                            {/* <Mail className="login-modal-input-icon" /> */}

                            <img src={Mail} alt="Icon 1" className="login-modal-input-icon" />
                            <input
                                type="email"
                                placeholder="Email"
                                value={email}
                                onChange={(e) => setEmail(e.target.value)}
                                className="login-modal-form-input"
                                required
                            />
                        </div>
                    </div>

                    <div className="login-modal-input-group">
                        <div className="login-modal-input-wrapper">
                            <img src={LOCK} alt="Icon 1" className="login-modal-input-icon lock-icon" />
                            <input
                                type="password"
                                placeholder="Password"
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                                className="login-modal-form-input"
                                required
                            />
                        </div>
                        <div className="login-modal-forgot-password">
                            <a href="/mymiro/forgot-password" className="login-modal-forgot-link">
                                Forgot Password?
                            </a>
                        </div>
                    </div>

                    <button type="submit" className="login-modal-login-button" disabled={loading}>
                        {loading ? 'Logging in...' : 'Log in'}
                    </button>
                </form>

                {/* Footer */}
                <div className="login-modal-footer">
                    <div className="login-modal-divider"></div>
                    <p className="login-modal-signup-text">
                        Don't have an account?{' '}
                        <a href="/mymiro/signup" className="login-modal-signup-link">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    );
};

export default LoginModal;