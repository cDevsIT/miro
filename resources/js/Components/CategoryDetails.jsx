// const { category, products } = usePage().props;
// import { usePage } from '@inertiajs/react';

import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import axios from 'axios';
import Loader from './Common/Loader';

const CategoryDetails = () => {
    // Get ID from URL path
    const pathParts = window.location.pathname.split('/');
    const id = pathParts[pathParts.length - 1];
    
    const [category, setCategory] = useState(null);
    const [products, setProducts] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [page, setPage] = useState(1);
    const [hasMore, setHasMore] = useState(true);
    const productsPerPage = 12;
    const [newProductsLoading, setNewProductsLoading] = useState(false);
    const [rows, setRows] = useState([]);
    const [windowWidth, setWindowWidth] = useState(window.innerWidth);

    useEffect(() => {
        const handleResize = () => {
            setWindowWidth(window.innerWidth);
        };

        window.addEventListener('resize', handleResize);
        return () => window.removeEventListener('resize', handleResize);
    }, []);

    useEffect(() => {
        const itemsPerRow = windowWidth <= 768 ? 10 : 4;
        const newRows = [];
        for (let i = 0; i < products.length; i += itemsPerRow) {
            newRows.push(products.slice(i, i + itemsPerRow));
        }
        setRows(newRows);
    }, [products, windowWidth]);

    useEffect(() => {
        const fetchCategoryAndProducts = async () => {
            try {
                if (page === 1) {
                    setLoading(true);
                } else {
                    setNewProductsLoading(true);
                }

                const response = await axios.get(`/api/product-category/details/${id}?page=${page}&per_page=${productsPerPage}`);
                
                if (page === 1) {
                    setCategory(response.data.category);
                    setProducts(response.data.products);
                } else {
                    // Add a small delay for animation
                    await new Promise(resolve => setTimeout(resolve, 500));
                    
                    // Only add new products that aren't already in the list
                    const newProducts = response.data.products.filter(
                        newProduct => !products.some(
                            existingProduct => existingProduct.model_number === newProduct.model_number
                        )
                    );
                    setProducts(prevProducts => [...prevProducts, ...newProducts]);
                }
                
                setHasMore(response.data.products.length === productsPerPage);
                setLoading(false);
                setNewProductsLoading(false);
            } catch (error) {
                setError(error.message);
                setLoading(false);
                setNewProductsLoading(false);
            }
        };

        if (id) {
            fetchCategoryAndProducts();
        } else {
            setLoading(false);
        }
    }, [id, page]);

    const loadMore = () => {
        if (!loading) {
            setPage(prevPage => prevPage + 1);
        }
    };

    if (loading && page === 1) {
        return <Loader />;
    }

    if (error) {
        return <div>Error: {error}</div>;
    }

    if (!category) {
        return <div>Category not found</div>;
    }

    return (
        <div>
            <div className='container breadcrumb'>
                <a className='breadcrumb-hide-mobile'  href={`/products/category/${category.type}`}>
                    {category.type === 'indoor' ? 'Indoor Products' : 'Outdoor Products'}
                </a> 
                <span className='breadcrumb-hide-mobile breadcrumb-slash'> / </span> 
                {category.parent && (
                    <>
                        <a className='breadcrumb-last' href={`/products/category/${category.type}`} onClick={(e) => {
                            e.preventDefault();
                            // Store the parent category with banners data in localStorage before navigating
                            const parentWithBanners = {
                                ...category.parent,
                                banners: category.parent.banners || []
                            };
                            localStorage.setItem('selectedCategory', JSON.stringify(parentWithBanners));
                            window.location.href = `/products/category/${category.type}`;
                        }}>
                            {category.parent.name}
                        </a>
                        <span className='breadcrumb-hide-mobile breadcrumb-slash'> / </span>
                    </>
                )}
                <a className='breadcrumb-hide-mobile' href='#'>{category.name}</a>
            </div>
            
            
            {(category.banners?.length > 0 || category.banner) && (
            <div className='container productCategoryDetails'>
                <div className='productCategoryDetailsLeft'>
                    {category.banners && category.banners.length > 0 ? (
                        <Swiper
                            modules={[Navigation, Pagination, Autoplay]}
                            spaceBetween={0}
                            slidesPerView={1}
                            navigation={true}
                            pagination={{ clickable: true }}
                            autoplay={{
                                delay: 5000,
                                disableOnInteraction: false,
                            }}
                            loop={true}
                            className="category-banner-swiper"
                        >
                            {category.banners.map((banner) => (
                                <SwiperSlide key={banner.id}>
                                    <img src={`/storage/${banner.image_path}`} alt={banner.alt_text || category.name} />
                                </SwiperSlide>
                            ))}
                        </Swiper>
                    ) : category.banner ? (
                        <img src={`/storage/${category.banner}`} alt={category.name} />
                    ) : null}
                </div>
                <div className='productCategoryDetailsRight'>
                    <h1>{category.name}</h1>
                    <p>{category.details}</p>
                    {category.link && (
                        <a href={category.link} className='readMoreButton' rel="noopener noreferrer">
                            Read more
                        </a>
                    )}
                </div>
            </div>
            )}

            {products.length > 0 && (
            <div className='productsContainer categoryDetails-productsContainer'>
                <div className='productsGrid'>
                    {rows.map((row, rowIndex) => (
                        <div key={rowIndex} className='imageGrid'>
                            {row.map((product, index) => (
                                <a 
                                    key={product.model_number} 
                                    href={`/products/${product.model_number}`} 
                                    className={`product-card ${page > 1 ? 'animate-in' : ''}`}
                                    // style={{
                                    //     animationDelay: `${(index % (windowWidth <= 768 ? 10 : 3)) * 0.2}s`
                                    // }}
                                >
                                    <div className='product-thumbnail'>
                                        <img src={`/storage/${product.thumbnail}`} alt={product.name} />
                                    </div>
                                    <div className='product-name'>
                                        {product.model_number}
                                        <div className='product-name-hover-bar'></div>
                                    </div>
                                </a>
                            ))}
                        </div>
                    ))}

                    {hasMore && (
                        <div className="exploreButtonContainer">
                            <button 
                                onClick={loadMore} 
                                className="exploreButton"
                                disabled={loading || newProductsLoading}
                            >
                                {newProductsLoading ? 'Loading...' : 'Explore more'}
                            </button>
                        </div>
                    )}
                </div>
            </div>
            )}
        </div>
    );
};

export default CategoryDetails; 