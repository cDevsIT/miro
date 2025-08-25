import React, { useState, useEffect } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import axios from 'axios';
import Loader from './Common/Loader';

const Products = ({ type }) => {
    const [categories, setCategories] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [selectedCategory, setSelectedCategory] = useState(null);

    useEffect(() => {
        const fetchCategories = async () => {
            try {
                let url = `/api/categories/${type}`;
                if (selectedCategory) {
                    url = `/api/categories/${type}/${selectedCategory.id}`;
                }
                
                const response = await axios.get(url);
                setCategories(response.data);
                setLoading(false);
            } catch (error) {
                console.error('Error fetching categories:', error);
                setError(error.message);
                setLoading(false);
            }
        };

        const fetchSelectedCategoryData = async () => {
            if (selectedCategory && !selectedCategory.banners) {
                try {
                    const response = await axios.get(`/api/product-category/details/${selectedCategory.id}`);
                    setSelectedCategory(response.data.category);
                } catch (error) {
                    console.error('Error fetching selected category data:', error);
                }
            }
        };

        // Check for selectedCategory in localStorage
        const storedCategory = localStorage.getItem('selectedCategory');
        if (storedCategory) {
            const parsedCategory = JSON.parse(storedCategory);
            setSelectedCategory(parsedCategory);
            localStorage.removeItem('selectedCategory'); // Clear after using
            
            // If the stored category doesn't have banners data, fetch it
            if (!parsedCategory.banners) {
                fetchSelectedCategoryData();
            }
        }

        if (type) {
            fetchCategories();
        }
    }, [type, selectedCategory]);

    const handleCategoryClick = (category) => {
        // If the category has a parent_id, it's a subcategory - redirect to details
        if (category.parent_id) {
            window.location.href = `/products/category-details/${category.id}`;
        } else {
            // If it's a main category, show its subcategories
            setSelectedCategory(category);
        }
    };

    const handleBackClick = () => {
        setSelectedCategory(null);
    };

    // Split categories into rows of 4
    const rows = [];
    for (let i = 0; i < categories.length; i += 4) {
        rows.push(categories.slice(i, i + 4));
    }

    if (loading) {
        return <Loader />;
    }

    if (error) {
        return <div>Error: {error}</div>;
    }

    return (
        <div>
            <div className='container breadcrumb'>
                
                {selectedCategory ? (
                    <>
                        <a className='breadcrumb-hide-mobile' href={`/products/category/${type}`} onClick={handleBackClick}>
                            {type === 'indoor' ? 'Indoor Products' : 'Outdoor Products'}
                        </a>
                        <span className='breadcrumb-hide-mobile breadcrumb-slash'> / </span>
                         <a href='#'>
                            {selectedCategory.name}
                        </a>
                    </>
                ) : (
                    <>
                        {type === 'indoor' ? (
                            <>
                                <a href='/products/category/indoor'>Indoor Products</a><span className='breadcrumb-hide-mobile breadcrumb-slash'> / </span> <a className='breadcrumb-hide-mobile' href='/products/category/outdoor'>Outdoor Products</a>
                            </>
                        ) : (
                            <>
                                <a href='/products/category/outdoor'>Outdoor Products</a><span className='breadcrumb-hide-mobile breadcrumb-slash'> / </span> <a  className='breadcrumb-hide-mobile' href='/products/category/indoor'>Indoor Products</a>
                            </>
                        )}
                    </>
                )}
            </div>

            {(selectedCategory?.banners?.length > 0 || selectedCategory?.banner || selectedCategory?.details) && (
            <div className='container productCategoryDetails'>
                <div className='productCategoryDetailsLeft'>
                    {selectedCategory?.banners && selectedCategory.banners.length > 0 ? (
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
                            {selectedCategory.banners.map((banner) => (
                                <SwiperSlide key={banner.id}>
                                    <img 
                                        src={`/storage/${banner.image_path || ''}`} 
                                        alt={banner.alt_text || selectedCategory.name || 'Category Banner'} 
                                    />
                                </SwiperSlide>
                            ))}
                        </Swiper>
                    ) : selectedCategory?.banner ? (
                        <img 
                            src={`/storage/${selectedCategory.banner}`} 
                            alt={selectedCategory.name || 'Category Banner'} 
                        />
                    ) : null}
                </div>
                <div className='productCategoryDetailsRight'>
                    <h1>{selectedCategory?.name || 'Category'}</h1>
                    <p>{selectedCategory?.details || ''}</p>
                    {selectedCategory?.link && (
                        <a href={selectedCategory.link} className='readMoreButton' rel="noopener noreferrer">
                            Read more
                        </a>
                    )}
                </div>
            </div>
            )}


            {categories.length > 0 && (
            <div className='productsContainer'>
                <div className={`productsGrid ${selectedCategory ? 'selectedCategoryproductsGrid' : ''}`}>
                    {rows.map((row, rowIndex) => (
                        <div key={rowIndex} className={`imageGrid ${selectedCategory ? 'selectedCategory' : ''}`}>
                            {row.map(category => (
                                <a
                                    key={category.id}
                                    href='#'
                                    onClick={(e) => {
                                        e.preventDefault();
                                        handleCategoryClick(category);
                                    }}
                                    className='product-card'
                                >
                                    <div className='product-thumbnail'>
                                        <img src={`/storage/${category.thumbnail}`} alt={category.name} />
                                    </div>
                                    <div className='product-name'>
                                        {category.name}
                                        <div className='product-name-hover-bar'></div>  
                                    </div>
                                </a>
                            ))}
                        </div>
                    ))}
                </div>
            </div>
            )}

        </div>
    );
};

export default Products; 