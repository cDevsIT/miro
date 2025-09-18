import React, { useState, useEffect } from 'react';
import BaseAlert from '../Common/BaseAlert';
import img1 from "../../../../public/images/LED RECESSED/01. MIR-D401A1001/FS-RNDO-002WBMW-W7.jpg";
import { useWishlist } from '../../contexts/WishlistContext';
import axios from 'axios';


const Wishlist = () => {

    const { wishlistItems, removeFromWishlist } = useWishlist();

    // Local UI state mirroring wishlist items for quantity/selection without changing design
    const [products, setProducts] = useState([]);

    useEffect(() => {
        // Map backend items to UI model expected by the existing design
        const mapped = (wishlistItems || []).map(item => ({
            // Use model number as the visible id per existing design
            id: item.model_number,
            name: item.title,
            // Prefer storage thumbnail; fallback to placeholder image if missing
            image: item.thumbnail ? `/storage/${item.thumbnail}` : img1,
            description: '',
            color: '',
            temperature: '',
            quantity: 1,
            selected: false,
            // Keep real product primary key for API ops if needed
            _productId: item.id,
        }));
        setProducts(mapped);
    }, [wishlistItems]);

    const [selectAll, setSelectAll] = useState(false);
    const [alert, setAlert] = useState({
        isOpen: false,
        itemId: null,
        isMultiple: false
    });

    // Navigate to the /products page
    const handleBrowseProducts = () => {
        navigate('/products');
    };

    // Handle select all
    const handleSelectAll = () => {
        setSelectAll(!selectAll);
        setProducts(products.map(product => ({
            ...product,
            selected: !selectAll
        })));
    };

    // Handle individual product selection
    const handleSelect = (id) => {
        setProducts(products.map(product =>
            product.id === id ? {
                ...product,
                selected: !product.selected
            } : product
        ));
        // Update selectAll state based on all products being selected
        const updatedProducts = products.map(product =>
            product.id === id ? { ...product, selected: !product.selected } : product
        );
        setSelectAll(updatedProducts.every(product => product.selected));
    };

    // Handle quantity changes
    const handleQuantityChange = (id, change) => {
        setProducts(products.map(product =>
            product.id === id ? {
                ...product,
                quantity: Math.max(1, product.quantity + change)
            } : product
        ));
    };

    // Handle product deletion
    const handleDelete = (id) => {
        setAlert({
            isOpen: true,
            itemId: id,
            isMultiple: false
        });
    };

    // Handle delete selected items
    const handleDeleteSelected = () => {
        if (!products.some(product => product.selected)) {
            return;
        }

        setAlert({
            isOpen: true,
            itemId: null,
            isMultiple: true
        });
    };

    const handleConfirmDelete = async () => {
        if (alert.isMultiple) {
            const toRemove = products.filter(product => product.selected);
            // Optimistic UI update
            setProducts(products.filter(product => !product.selected));
            setSelectAll(false);
            // Persist removals
            for (const p of toRemove) {
                try { await removeFromWishlist(p._productId || p.id); } catch (e) {}
            }
        } else if (alert.itemId) {
            const item = products.find(p => p.id === alert.itemId);
            setProducts(products.filter(product => product.id !== alert.itemId));
            if (item) {
                try { await removeFromWishlist(item._productId || item.id); } catch (e) {}
            }
        }
        setAlert({ isOpen: false, itemId: null, isMultiple: false });
    };

    // Get selected products for summary
    const getSelectedProducts = () => {
        return products.filter(product => product.selected);
    };

    // Calculate total selected items
    const getTotalSelectedItems = () => {
        return getSelectedProducts().reduce((total, product) => total + product.quantity, 0);
    };

    return (
        <>
            {products.length > 0 ? (

                <div className="wishlist-page">
                    <div className="wishlist-main">
                        <div className="select-all-bar">
                            <label className="select-all">
                                <input
                                    type="checkbox"
                                    checked={selectAll}
                                    onChange={handleSelectAll}
                                />
                                <span>Select All Items</span>
                            </label>
                            <button
                                className="delete-btn"
                                onClick={handleDeleteSelected}
                                style={{ opacity: products.some(p => p.selected) ? 1 : 0.5 }}
                            >
                                <i className="far fa-trash-alt"></i>
                            </button>
                        </div>

                        <h2 className="saved-products-title">Saved Products</h2>

                        <div className="products-list">
                            {products.map((product) => (
                                <div key={product.id} >
                                    <div className="product-item">
                                        
                                        <div className="checkbox-wrapper pc-wish-check">
                                            <input
                                                type="checkbox"
                                                checked={product.selected}
                                                onChange={() => handleSelect(product.id)}
                                            />
                                        </div>
                                        
                                        <div className="product-image">
                                            <img src={product.image} alt={product.name} />
                                        </div>
                                        
                                        <div className="wishlist-product-details">
                                            <div className='mobile-check-div' >
                                                <h3>{product.name}</h3>
                                                <div className="checkbox-wrapper mobile-wish-check">
                                                    <input
                                                        type="checkbox"
                                                        checked={product.selected}
                                                        onChange={() => handleSelect(product.id)}
                                                    />
                                                </div>
                                            </div>
                                            <p className="product-id">{product.id}</p>
                                            <p className="product-description">{product.description}</p>
                                            <div className="product-specs">
                                                <span>{product.color}</span>
                                                <span>{product.temperature}</span>
                                            </div>
                                        </div>

                                        <div className="product-actions mobile-wish-info-delete">

                                            <div className="quantity-control">
                                                <button
                                                    className="quantity-btn"
                                                    onClick={() => handleQuantityChange(product.id, -1)}
                                                >−</button>
                                                <span>{product.quantity}</span>
                                                <button
                                                    className="quantity-btn"
                                                    onClick={() => handleQuantityChange(product.id, 1)}
                                                >+</button>
                                            </div>

                                            <div className="action-links">
                                                <button className="more-info">more info</button>
                                                <button
                                                    className="delete"
                                                    onClick={() => handleDelete(product.id)}
                                                >
                                                    <i className="far fa-trash-alt"></i>
                                                </button>
                                            </div>

                                        </div>

                                        <div className="mobile-product-actions mobile-wish-new-info-delete">

                                            <div className="action-links">
                                                <button className="more-info">more info</button>
                                                <button
                                                    className="delete"
                                                    onClick={() => handleDelete(product.id)}
                                                >
                                                    <i className="far fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                    </div>

                                </div>


                            ))}
                        </div>

                        <div className='add-more-div' >
                            <button className="add-more">
                                + Add more products
                            </button>
                        </div>
                    </div>

                    <div className="product-summary">
                        <h2>Product Summary</h2>
                        {getSelectedProducts().length > 0 ? (
                            <>
                                <div className="summary-items">
                                    {getSelectedProducts().map(product => (
                                        <div key={product.id} className="summary-item">
                                            <div>
                                                <h4>{product.name}</h4>
                                                <p>{product.id}</p>
                                            </div>
                                            <span>{product.quantity} items</span>
                                        </div>
                                    ))}
                                    <div className="summary-total">
                                        <span>Total Products</span>
                                        <span>{getTotalSelectedItems()} items</span>
                                    </div>
                                </div>
                                <div className='quotation-div' >
                                    <button
                                        className="get-quotation"
                                        onClick={async () => {
                                            const selected = getSelectedProducts();
                                            if (selected.length === 0) return;
                                            try {
                                                const payload = {
                                                    items: selected.map(p => ({
                                                        product_id: p._productId || p.id,
                                                        quantity: p.quantity || 1,
                                                    }))
                                                };
                                                await axios.post('/api/quotes', payload);
                                                // Optionally navigate to quotes tab if parent provides it
                                                if (typeof window?.setActiveTab === 'function') {
                                                    window.setActiveTab('get-quote');
                                                }
                                            } catch (e) {
                                                console.error('Failed to create quote', e);
                                            }
                                        }}
                                    >
                                        Get a quotation
                                    </button>
                                </div>
                            </>
                        ) : (
                            <p className="empty-message">No products selected.</p>
                        )}
                    </div>
                </div>

            ) : (

                <div class="wishlist-container">
                    <h2>My Wishlist</h2>
                    <p class="empty-message">Wishlist is empty... for now!</p>
                    <p class="start-adding">Start adding your favorite items.</p>
                    <a href="http://localhost:8000/products" class="browse-products action-links-button" >Browse Products
                    <span className='action-link-underline'></span>
                    </a>
                </div>

            )}

            <BaseAlert
                isOpen={alert.isOpen}
                onClose={() => setAlert({ isOpen: false, itemId: null, isMultiple: false })}
                onConfirm={handleConfirmDelete}
                title={alert.isMultiple ? "Delete Selected Items" : "Delete Item"}
                message={alert.isMultiple
                    ? "Are you sure you want to delete all selected items?"
                    : "Are you sure you want to delete this item?"
                }
                confirmText="Delete"
                type="delete"
            />
        </>
    );
};

export default Wishlist; 