import React, { useState } from 'react';
import { useAuth } from '../hooks/useAuth';

const AuthTest = () => {
    const { isAuthenticated, user, loading, login, logout, register } = useAuth();
    const [error, setError] = useState(null);
    const [loginData, setLoginData] = useState({ email: '', password: '' });
    const [registerData, setRegisterData] = useState({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        profession: '',
        phone: ''
    });

    const handleLogin = async (e) => {
        e.preventDefault();
        setError(null);
        try {
            await login(loginData);
        } catch (error) {
            setError(error.message);
        }
    };

    const handleRegister = async (e) => {
        e.preventDefault();
        setError(null);
        try {
            await register(registerData);
        } catch (error) {
            setError(error.message);
        }
    };

    const handleLogout = async () => {
        try {
            await logout();
        } catch (error) {
            setError(error.message);
        }
    };

    if (loading) {
        return <div>Loading...</div>;
    }

    return (
        <div style={{ padding: '20px', maxWidth: '500px', margin: '0 auto' }}>
            <h1>Auth Test Component</h1>
            
            {error && (
                <div style={{ color: 'red', marginBottom: '20px' }}>
                    Error: {error}
                </div>
            )}

            <div style={{ marginBottom: '20px' }}>
                <h2>Auth Status:</h2>
                <p>Is Authenticated: {isAuthenticated ? 'Yes' : 'No'}</p>
                {user && (
                    <div>
                        <h3>User Info:</h3>
                        <pre>{JSON.stringify(user, null, 2)}</pre>
                    </div>
                )}
            </div>

            {!isAuthenticated ? (
                <div>
                    <div style={{ marginBottom: '30px' }}>
                        <h2>Login Form</h2>
                        <form onSubmit={handleLogin}>
                            <div style={{ marginBottom: '10px' }}>
                                <input
                                    type="email"
                                    placeholder="Email"
                                    value={loginData.email}
                                    onChange={(e) => setLoginData({ ...loginData, email: e.target.value })}
                                    style={{ width: '100%', padding: '8px' }}
                                />
                            </div>
                            <div style={{ marginBottom: '10px' }}>
                                <input
                                    type="password"
                                    placeholder="Password"
                                    value={loginData.password}
                                    onChange={(e) => setLoginData({ ...loginData, password: e.target.value })}
                                    style={{ width: '100%', padding: '8px' }}
                                />
                            </div>
                            <button type="submit" style={{ padding: '8px 16px' }}>Login</button>
                        </form>
                    </div>

                    <div>
                        <h2>Register Form</h2>
                        <form onSubmit={handleRegister}>
                            <div style={{ marginBottom: '10px' }}>
                                <input
                                    type="text"
                                    placeholder="Name"
                                    value={registerData.name}
                                    onChange={(e) => setRegisterData({ ...registerData, name: e.target.value })}
                                    style={{ width: '100%', padding: '8px' }}
                                />
                            </div>
                            <div style={{ marginBottom: '10px' }}>
                                <input
                                    type="email"
                                    placeholder="Email"
                                    value={registerData.email}
                                    onChange={(e) => setRegisterData({ ...registerData, email: e.target.value })}
                                    style={{ width: '100%', padding: '8px' }}
                                />
                            </div>
                            <div style={{ marginBottom: '10px' }}>
                                <input
                                    type="password"
                                    placeholder="Password"
                                    value={registerData.password}
                                    onChange={(e) => setRegisterData({ ...registerData, password: e.target.value })}
                                    style={{ width: '100%', padding: '8px' }}
                                />
                            </div>
                            <div style={{ marginBottom: '10px' }}>
                                <input
                                    type="password"
                                    placeholder="Confirm Password"
                                    value={registerData.password_confirmation}
                                    onChange={(e) => setRegisterData({ ...registerData, password_confirmation: e.target.value })}
                                    style={{ width: '100%', padding: '8px' }}
                                />
                            </div>
                            <div style={{ marginBottom: '10px' }}>
                                <input
                                    type="text"
                                    placeholder="Profession"
                                    value={registerData.profession}
                                    onChange={(e) => setRegisterData({ ...registerData, profession: e.target.value })}
                                    style={{ width: '100%', padding: '8px' }}
                                />
                            </div>
                            <div style={{ marginBottom: '10px' }}>
                                <input
                                    type="text"
                                    placeholder="Phone"
                                    value={registerData.phone}
                                    onChange={(e) => setRegisterData({ ...registerData, phone: e.target.value })}
                                    style={{ width: '100%', padding: '8px' }}
                                />
                            </div>
                            <button type="submit" style={{ padding: '8px 16px' }}>Register</button>
                        </form>
                    </div>
                </div>
            ) : (
                <div>
                    <button onClick={handleLogout} style={{ padding: '8px 16px' }}>Logout</button>
                </div>
            )}
        </div>
    );
};

export default AuthTest; 