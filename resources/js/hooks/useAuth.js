import { useState, useEffect } from 'react';
import axios from 'axios';

// Configure axios defaults
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.withCredentials = true;

export const useAuth = () => {
    const [isAuthenticated, setIsAuthenticated] = useState(false);
    const [user, setUser] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        checkAuthStatus();
    }, []);

    const checkAuthStatus = async() => {
        try {
            const response = await axios.get('/mymiro/customer-data');
            setIsAuthenticated(true);
            setUser(response.data.customer);
        } catch (error) {
            setIsAuthenticated(false);
            setUser(null);
        } finally {
            setLoading(false);
        }
    };

    const login = async(credentials) => {
        try {
            const response = await axios.post('/mymiro/login', credentials);
            if (response.data.customer) {
                setIsAuthenticated(true);
                setUser(response.data.customer);

                // Handle return URL if it exists
                const urlParams = new URLSearchParams(window.location.search);
                const returnUrl = urlParams.get('returnUrl');
                if (returnUrl) {
                    window.location.href = returnUrl;
                }

                return response.data;
            }
            throw new Error(response.data.message || 'Login failed');
        } catch (error) {
            setIsAuthenticated(false);
            setUser(null);
            const message = error.response && error.response.data ? error.response.data.message : 'Login failed';
            throw new Error(message);
        }
    };

    const logout = async() => {
        try {
            await axios.post('/mymiro/logout');
            setIsAuthenticated(false);
            setUser(null);
            window.location.href = '/mymiro/login';
        } catch (error) {
            console.error('Logout failed:', error);
        }
    };

    const register = async(userData) => {
        try {
            const response = await axios.post('/mymiro/signup', userData);
            if (response.data.customer) {
                setIsAuthenticated(true);
                setUser(response.data.customer);

                // Handle return URL if it exists
                const urlParams = new URLSearchParams(window.location.search);
                const returnUrl = urlParams.get('returnUrl');
                if (returnUrl) {
                    window.location.href = returnUrl;
                }

                return response.data;
            }
            throw new Error(response.data.message || 'Registration failed');
        } catch (error) {
            setIsAuthenticated(false);
            setUser(null);
            const message = error.response && error.response.data ? error.response.data.message : 'Registration failed';
            throw new Error(message);
        }
    };

    return {
        isAuthenticated,
        user,
        loading,
        login,
        logout,
        register,
        checkAuthStatus
    };
};