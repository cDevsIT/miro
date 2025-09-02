import React, { createContext, useContext, useState, useEffect } from 'react';

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

    // Check if item is in wishlist
    const isInWishlist = (productId) => {
        return wishlistItems.some(item => item.id === productId);
    };

    // Add item to wishlist
    const addToWishlist = (product) => {
        if (!isInWishlist(product.id)) {
            setWishlistItems(prev => [...prev, { ...product, quantity: 1 }]);
        }
    };

    // Remove item from wishlist
    const removeFromWishlist = (productId) => {
        setWishlistItems(prev => prev.filter(item => item.id !== productId));
    };

    // Toggle wishlist item (add if not present, remove if present)
    const toggleWishlist = (product) => {
        if (isInWishlist(product.id)) {
            removeFromWishlist(product.id);
        } else {
            addToWishlist(product);
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
