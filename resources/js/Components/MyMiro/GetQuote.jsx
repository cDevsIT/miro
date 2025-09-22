import React, { useState, useEffect } from 'react';
import BaseAlert from '../Common/BaseAlert';
import img1 from "../../../../public/images/LED RECESSED/01. MIR-D401A1001/FS-RNDO-002WBMW-W7.jpg";
import axios from 'axios';

const QuotePage = ({ setActiveTab }) => {
    const [quote, setQuote] = useState(false);
    const [quoteStatus, setQuoteStatus] = useState('');
    const [quoteCode, setQuoteCode] = useState('');

    const [products, setProducts] = useState([]);

    useEffect(() => {
        const loadLatestQuote = async () => {
            try {
                const { data } = await axios.get('/api/quotes/latest');
                if (data && data.items) {
                    // Set quote information
                    setQuoteStatus(data.status || 'pending');
                    setQuoteCode(data.code || '');
                    
                    // Fetch full product details for each item to get colors
                    const productsWithDetails = await Promise.all(
                        data.items.map(async (it) => {
                            try {
                                const productResponse = await axios.get(`/api/products/${it.id}`);
                                const productData = productResponse.data;
                                return {
                                    id: it.id,
                                    name: it.name,
                                    image: it.image || img1,
                                    quantity: it.quantity || 1,
                                    selected: false,
                                    bodyColors: productData.colors && productData.colors.length > 0 
                                        ? productData.colors.map(color => color.name)
                                        : ['Standard'],
                                    colorTemperature: productData.specifications && productData.specifications['Color Temperature (CCT)'] 
                                        ? productData.specifications['Color Temperature (CCT)']
                                        : 'Standard'
                                };
                            } catch (e) {
                                // Fallback if product details can't be fetched
                                return {
                                    id: it.id,
                                    name: it.name,
                                    image: it.image || img1,
                                    quantity: it.quantity || 1,
                                    selected: false,
                                    bodyColors: ['Standard'],
                                    colorTemperature: 'Standard'
                                };
                            }
                        })
                    );
                    setProducts(productsWithDetails);
                    setQuote(true);
                } else {
                    setProducts([]);
                    setQuote(false);
                    setQuoteStatus('');
                    setQuoteCode('');
                }
            } catch (e) {
                setProducts([]);
                setQuote(false);
                setQuoteStatus('');
                setQuoteCode('');
            }
        };
        loadLatestQuote();
    }, []);

    const [selectAll, setSelectAll] = useState(false);
    const [alert, setAlert] = useState({
        isOpen: false,
        itemId: null,
        isMultiple: false
    });

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
            {quote ? (
                <div className="quote-page">
                    <div className="quote-main">
                        <h2 className="quote-title">Requested Quote - MIRQ01</h2>
                        <div className="quote-products-list">
                            {products.map((product) => (
                                <div key={product.id} className="quote-product-item">
                                    <div className="quote-product-image">
                                        <img src={product.image} alt={product.name} />
                                    </div>
                                    <div className="quote-product-details">
                                        <div className='mobile-check-div' >
                                            <h3>{product.name}</h3>
                                        </div>
                                        <p className="quote-product-id">{product.id}</p>
                                        <div className="quote-product-specs">
                                            <span>{product.bodyColors.join(', ')}</span>
                                            <span>{product.colorTemperature}</span>
                                        </div>
                                    </div>

                                    <div className="quote-product-actions mobile-wish-info-delete">

                                        <div className="quote-quantity-control">
                                            <span>{product.quantity} Items</span>
                                        </div>

                                        <div className="quote-action-links">
                                            <a target='_blank' href={`/products/${product.id}`} className="quote-more-info">more info</a>
                                        </div>
                                    </div>

                                    <div className='mobile-product-actions mobile-wish-new-info-delete' >
                                        <div className="quote-action-links">
                                            <a href={`/products/${product.id}`} className="quote-more-info">more info</a>
                                        </div>
                                    </div>

                                </div>
                            ))}

                            <div className='add-more-div' >
                                <button onClick={() => setActiveTab('wishlist')} className="add-more">
                                    + get another quote
                                </button>
                            </div>
                        </div>
                    </div>

                    <div className="quote-summary">
                        <h2>Product Summary</h2>

                        <div className="quote-summary-items">
                            {products.map(product => (
                                <div key={product.id} className="quote-summary-item">
                                    <div>
                                        <h4>{product.name}</h4>
                                        <p>{product.id}</p>
                                    </div>
                                    <span>{product.quantity} items</span>
                                </div>
                            ))}
                            <div className="quote-summary-total">
                                <span>Total Products</span>
                                <span>{getTotalSelectedItems()} items</span>
                            </div>
                        </div>

                        <div className="quote-quotation">
                            <button className="quote-get-quotation">
                            Status : {quoteStatus.charAt(0).toUpperCase() + quoteStatus.slice(1)}
                            </button>
                        </div>

                        <p className='quote-boq-request' >Your BOQ request is under review. Please check back soon for updates.</p>
                    </div>
                </div >
            ) : (
                <div className="no-quotes-container">
                    <h2>No Quotes Yet – Request One Now!</h2>
                    <p className='empty-message' >You haven't requested a quote yet!</p>
                    <p className='start-adding' >Need pricing or details? Submit your request now!</p>
                    <button className="go-to-wishlist action-links-button"
                        onClick={() => {
                            setActiveTab('wishlist');
                        }}
                    >
                        Go to Wishlist
                        <span className='action-link-underline'></span>
                    </button>
                </div>
            )}
        </>
    );
};

export default QuotePage;
