import React, { createContext, useContext, useState, useEffect } from 'react';
import axios from 'axios';
import { useAuth } from '../hooks/useAuth';

const WishlistContext = createContext();

export const useWishlist = () => {
    const context = useContext(WishlistContext);
    if (!context) {
        throw new Error('useWishlist must be used within a WishlistProvider');
    }
    return context;
};

export const WishlistProvider = ({ children }) => {
    // Start with empty wishlist
    const [wishlistItems, setWishlistItems] = useState([]);
    const { isAuthenticated, user } = useAuth();

    // Load wishlist for authenticated customer
    useEffect(() => {
        const loadWishlist = async () => {
            if (!isAuthenticated) {
                setWishlistItems([]);
                return;
            }
            try {
                const { data } = await axios.get('/api/wishlist');
                // Expect items: [{id, title, model_number, thumbnail}]
                setWishlistItems(data || []);
            } catch (err) {
                // Fallback to empty if unauthorized or error
                if (err.response && err.response.status === 401) {
                    setWishlistItems([]);
                }
            }
        };
        loadWishlist();
    }, [isAuthenticated, user?.id]);

    // Check if item is in wishlist
    const isInWishlist = (productId) => {
        return wishlistItems.some(item => item.id === productId);
    };

    // Add item to wishlist
    const addToWishlist = async (product) => {
        if (isInWishlist(product.id)) return;
        // Optimistic update
        setWishlistItems(prev => [...prev, { ...product, quantity: 1 }]);
        try {
            await axios.post('/api/wishlist/toggle', { product_id: product.id });
        } catch (err) {
            // Revert on failure
            setWishlistItems(prev => prev.filter(item => item.id !== product.id));
            throw err;
        }
    };

    // Remove item from wishlist
    const removeFromWishlist = async (productId) => {
        const previous = wishlistItems;
        setWishlistItems(prev => prev.filter(item => item.id !== productId));
        try {
            await axios.delete(`/api/wishlist/${productId}`);
        } catch (err) {
            setWishlistItems(previous);
            throw err;
        }
    };

    // Toggle wishlist item (add if not present, remove if present)
    const toggleWishlist = async (product) => {
        if (!product || !product.id) return;
        if (isInWishlist(product.id)) {
            await removeFromWishlist(product.id);
        } else {
            await addToWishlist(product);
        }
    };

    // Get wishlist count
    const getWishlistCount = () => {
        return wishlistItems.length;
    };

    // Update item quantity
    const updateQuantity = (productId, quantity) => {
        setWishlistItems(prev =>
            prev.map(item =>
                item.id === productId
                    ? { ...item, quantity: Math.max(1, quantity) }
                    : item
            )
        );
    };

    const value = {
        wishlistItems,
        isInWishlist,
        addToWishlist,
        removeFromWishlist,
        toggleWishlist,
        getWishlistCount,
        updateQuantity
    };

    return (
        <WishlistContext.Provider value={value}>
            {children}
        </WishlistContext.Provider>
    );
};

export default WishlistContext;
