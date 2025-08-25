import React, { useState } from 'react';
import BaseAlert from '../Common/BaseAlert';
import img1 from "../../../../public/images/LED RECESSED/01. MIR-D401A1001/FS-RNDO-002WBMW-W7.jpg";

const QuotePage = ({ setActiveTab }) => {
    const [quote, setQuote] = useState(false); // State to handle if there is a quote or not

    const [products, setProducts] = useState([
        {
            id: 'MIR-D401A1001',
            name: 'Recessed Adjustable Luminaire',
            image: img1,
            description: 'Recessed on ceiling',
            color: 'Matte White',
            temperature: '3000k',
            quantity: 3,
            selected: false
        },
        {
            id: 'MIR-D401A1030',
            name: 'Surface Adjustable Luminaire',
            image: img1,
            description: 'Recessed on ceiling',
            color: 'Matte White',
            temperature: '4000k',
            quantity: 1,
            selected: false
        }
    ]);

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
                                    <div className="quote-checkbox-wrapper pc-wish-check">
                                        <input
                                            type="checkbox"
                                            checked={product.selected}
                                            onChange={() => handleSelect(product.id)}
                                        />
                                    </div>
                                    <div className="quote-product-image">
                                        <img src={product.image} alt={product.name} />
                                    </div>
                                    <div className="quote-product-details">
                                        <div className='mobile-check-div' >
                                            <h3>{product.name}</h3>
                                            <div className="quote-checkbox-wrapper mobile-wish-check">
                                                <input
                                                    type="checkbox"
                                                    checked={product.selected}
                                                    onChange={() => handleSelect(product.id)}
                                                />
                                            </div>
                                        </div>
                                        <p className="quote-product-id">{product.id}</p>
                                        <p className="quote-product-description">{product.description}</p>
                                        <div className="quote-product-specs">
                                            <span>{product.color}</span>
                                            <span>{product.temperature}</span>
                                        </div>
                                    </div>

                                    <div className="quote-product-actions mobile-wish-info-delete">

                                        <div className="quote-quantity-control">
                                            <button
                                                className="quote-quantity-btn"
                                                onClick={() => handleQuantityChange(product.id, -1)}
                                            >−</button>
                                            <span>{product.quantity}</span>
                                            <button
                                                className="quote-quantity-btn"
                                                onClick={() => handleQuantityChange(product.id, 1)}
                                            >+</button>
                                        </div>

                                        <div className="quote-action-links">
                                            <button className="quote-more-info">more info</button>
                                            <button
                                                className="quote-delete"
                                                onClick={() => handleDelete(product.id)}
                                            >
                                                <i className="far fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div className='mobile-product-actions mobile-wish-new-info-delete' >
                                        <div className="quote-action-links">
                                            <button className="quote-more-info">more info</button>
                                            <button
                                                className="quote-delete"
                                                onClick={() => handleDelete(product.id)}
                                            >
                                                <i className="far fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            ))}

                            <div className='add-more-div' >
                                <button className="add-more">
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
                            <button className="quote-get-quotation">Get a quotation</button>
                        </div>

                        <p className='quote-boq-request' >Your BOQ request is under review. Please check back soon for updates.</p>
                    </div>
                </div >
            ) : (
                <div className="no-quotes-container">
                    <h2>No Quotes Yet – Request One Now!</h2>
                    <p className='empty-message' >You haven’t requested a quote yet!</p>
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
