import React, { useState, useRef, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import MatteWhiteIcon from '../../../public/images/products/product_attribute/White.png';
import MatteBlackIcon from '../../../public/images/products/product_attribute/Black.png';

import RightArrow from '../../icons/arrow-right.jsx';
import LeftArrow from '../../icons/arrow-left.jsx';
import RightArrowLight from '../../icons/arrow-right-light.jsx';
import LeftArrowLight from '../../icons/arrow-left-light.jsx';
import axios from 'axios';
import ProductActions from './ProductActions';
import Header from './Header';

const ProductDetails = () => {

    const pathParts = window.location.pathname.split('/');
    const modelNumber = pathParts[pathParts.length - 1];

    const [product, setProduct] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [activeImage, setActiveImage] = useState(0);
    const [swiper, setSwiper] = useState(null);
    const [isMobile, setIsMobile] = useState(window.innerWidth < 768);
    const [isTableAtEnd, setIsTableAtEnd] = useState(false);
    const [isTableAtStart, setIsTableAtStart] = useState(false);
    const [reachedAtEnd, setReachedAtEnd] = useState(false);
    const [reachedAtStart, setReachedAtStart] = useState(true);
    const [showMoreInfo, setShowMoreInfo] = useState(true);

    // Dimension options scroll states
    const [isDimensionAtEnd, setIsDimensionAtEnd] = useState(false);
    const [isDimensionAtStart, setIsDimensionAtStart] = useState(false);
    const [reachedDimensionAtEnd, setReachedDimensionAtEnd] = useState(false);
    const [reachedDimensionAtStart, setReachedDimensionAtStart] = useState(true);

    // Reflector color options scroll states
    const [isReflectorAtEnd, setIsReflectorAtEnd] = useState(false);
    const [isReflectorAtStart, setIsReflectorAtStart] = useState(false);
    const [reachedReflectorAtEnd, setReachedReflectorAtEnd] = useState(false);
    const [reachedReflectorAtStart, setReachedReflectorAtStart] = useState(true);

    const prevRef = useRef(null);
    const nextRef = useRef(null);
    const tableContainerRef = useRef(null);
    const dimensionContainerRef = useRef(null);
    const reflectorContainerRef = useRef(null);

    // Check if device is mobile
    useEffect(() => {
        const handleResize = () => {
            setIsMobile(window.innerWidth < 768);
        };

        window.addEventListener('resize', handleResize);
        return () => window.removeEventListener('resize', handleResize);
    }, []);

    // Handle table scroll for mobile family products - more robust approach
    useEffect(() => {
        const setupScrollDetection = () => {
            // Try ref first, then class selector
            let container = tableContainerRef.current || document.querySelector('.family-products-mobile-table-container');

            if (container) {
                console.log('Found table container, setting up scroll detection');

                let scrollTimeout;
                let lastScrollLeft = 0;
                const handleScroll = () => {
                    clearTimeout(scrollTimeout);
                    scrollTimeout = setTimeout(() => {
                        const scrollLeft = container.scrollLeft;
                        const clientWidth = container.clientWidth;
                        const scrollWidth = container.scrollWidth;

                        // Only update if scroll position actually changed significantly
                        if (Math.abs(scrollLeft - lastScrollLeft) < 5) {
                            return;
                        }
                        lastScrollLeft = scrollLeft;

                        const isAtEnd = scrollLeft + clientWidth >= scrollWidth - 10;
                        const isAtStart = scrollLeft <= 10;

                        console.log('Scroll detection:', { scrollLeft, clientWidth, scrollWidth, isAtEnd, isAtStart });

                        setIsTableAtStart(isAtStart);
                        setIsTableAtEnd(isAtEnd);

                        // Update reached states - only change when actually crossing boundaries
                        if (isAtEnd && !reachedAtEnd) {
                            setReachedAtEnd(true);
                            setReachedAtStart(false);
                            console.log('Setting reachedAtEnd to true');
                        } else if (isAtStart && !reachedAtStart) {
                            setReachedAtStart(true);
                            setReachedAtEnd(false);
                            console.log('Setting reachedAtEnd to false');
                        } else if (!isAtEnd && !isAtStart) {
                            // In the middle - don't change states
                            console.log('In middle, keeping current states');
                        }
                    }, 100); // Increased debounce time
                };

                // Remove any existing listeners
                container.removeEventListener('scroll', handleScroll);

                // Add new listener
                container.addEventListener('scroll', handleScroll);

                // Check initial state
                handleScroll();

                return () => {
                    container.removeEventListener('scroll', handleScroll);
                    clearTimeout(scrollTimeout);
                };
            } else {
                console.log('Table container not found');
            }
        };

        // Setup immediately
        const cleanup = setupScrollDetection();

        // Also setup after a delay to catch any late-rendering
        const timeoutId = setTimeout(() => {
            setupScrollDetection();
        }, 500);

        return () => {
            if (cleanup) cleanup();
            clearTimeout(timeoutId);
        };
    }, [product, showMoreInfo, reachedAtEnd]);

    // Handle dimension options scroll for mobile
    useEffect(() => {
        const setupDimensionScrollDetection = () => {
            let container = dimensionContainerRef.current || document.querySelector('.dimension-choices');

            if (container) {
                let scrollTimeout;
                let lastScrollLeft = 0;
                const handleScroll = () => {
                    clearTimeout(scrollTimeout);
                    scrollTimeout = setTimeout(() => {
                        const scrollLeft = container.scrollLeft;
                        const clientWidth = container.clientWidth;
                        const scrollWidth = container.scrollWidth;

                        if (Math.abs(scrollLeft - lastScrollLeft) < 5) {
                            return;
                        }
                        lastScrollLeft = scrollLeft;

                        const isAtEnd = scrollLeft + clientWidth >= scrollWidth - 10;
                        const isAtStart = scrollLeft <= 10;

                        setIsDimensionAtStart(isAtStart);
                        setIsDimensionAtEnd(isAtEnd);

                        if (isAtEnd && !reachedDimensionAtEnd) {
                            setReachedDimensionAtEnd(true);
                            setReachedDimensionAtStart(false);
                        } else if (isAtStart) {
                            setReachedDimensionAtStart(true);
                            setReachedDimensionAtEnd(false);
                        }
                    }, 100);
                };

                container.removeEventListener('scroll', handleScroll);
                container.addEventListener('scroll', handleScroll);
                handleScroll();

                return () => {
                    container.removeEventListener('scroll', handleScroll);
                    clearTimeout(scrollTimeout);
                };
            }
        };

        const cleanup = setupDimensionScrollDetection();
        const timeoutId = setTimeout(() => {
            setupDimensionScrollDetection();
        }, 500);

        return () => {
            if (cleanup) cleanup();
            clearTimeout(timeoutId);
        };
    }, [product, showMoreInfo, reachedDimensionAtEnd]);

    // Handle reflector color options scroll for mobile
    useEffect(() => {
        const setupReflectorScrollDetection = () => {
            let container = reflectorContainerRef.current || document.querySelector('.reflector-color-choices');

            if (container) {
                let scrollTimeout;
                let lastScrollLeft = 0;
                const handleScroll = () => {
                    clearTimeout(scrollTimeout);
                    scrollTimeout = setTimeout(() => {
                        const scrollLeft = container.scrollLeft;
                        const clientWidth = container.clientWidth;
                        const scrollWidth = container.scrollWidth;

                        if (Math.abs(scrollLeft - lastScrollLeft) < 5) {
                            return;
                        }
                        lastScrollLeft = scrollLeft;

                        const isAtEnd = scrollLeft + clientWidth >= scrollWidth - 10;
                        const isAtStart = scrollLeft <= 10;

                        setIsReflectorAtStart(isAtStart);
                        setIsReflectorAtEnd(isAtEnd);

                        if (isAtEnd && !reachedReflectorAtEnd) {
                            setReachedReflectorAtEnd(true);
                            setReachedReflectorAtStart(false);
                        } else if (isAtStart) {
                            setReachedReflectorAtStart(true);
                            setReachedReflectorAtEnd(false);
                        }
                    }, 100);
                };

                container.removeEventListener('scroll', handleScroll);
                container.addEventListener('scroll', handleScroll);
                handleScroll();

                return () => {
                    container.removeEventListener('scroll', handleScroll);
                    clearTimeout(scrollTimeout);
                };
            }
        };

        const cleanup = setupReflectorScrollDetection();
        const timeoutId = setTimeout(() => {
            setupReflectorScrollDetection();
        }, 500);

        return () => {
            if (cleanup) cleanup();
            clearTimeout(timeoutId);
        };
    }, [product, showMoreInfo, reachedReflectorAtEnd]);

    useEffect(() => {
        const fetchProductDetails = async () => {
            try {
                const response = await axios.get(`/api/products/${modelNumber}`);
                setProduct(response.data);
                setLoading(false);
            } catch (error) {
                console.error('Error fetching product details:', error);
                setError(error.message);
                setLoading(false);
            }
        };

        if (modelNumber) {
            fetchProductDetails();
        }
    }, [modelNumber]);


    // console.log(product);

    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error: {error}</div>;
    if (!product) return <div>Product not found</div>;

    // Handle navigation button clicks
    const handlePrevClick = () => {
        if (swiper) {
            swiper.slidePrev();
        }
    };

    const handleNextClick = () => {
        if (swiper) {
            swiper.slideNext();
        }
    };


    return (
        <>
            <Header />
            <div className={`product-details ${product.model_number}`}>
                <div className='container breadcrumb'>
                    <a className='breadcrumb-hide-mobile' href={`/products/category/${product.categories[0]?.type}`}>
                        {product.categories[0]?.type === 'indoor' ? 'Indoor Products' : 'Outdoor Products'}
                    </a>
                    <span className='breadcrumb-hide-mobile breadcrumb-slash'> / </span>
                    <a href={`/products/category-details/${product.categories[0]?.id}`}>{product.categories[0]?.name}</a>
                    <span className='breadcrumb-hide-mobile breadcrumb-slash'> / </span>
                    <a className='breadcrumb-hide-mobile' href='#'>{product.model_number}</a>
                </div>

                <div className="product-details-grid container-right-offset">

                    {/* Product Images */}
                    <div className="product-images">
                        <div className="main-image">

                            <span className='product-action-container'>
                                <ProductActions product={product} />
                            </span>

                            <Swiper
                                spaceBetween={30}
                                pagination={{
                                    clickable: true,
                                }}
                                modules={[Pagination]}
                                className="mySwiper"
                            >
                                {product.images.map((image) => (
                                    <SwiperSlide key={image.id}>
                                        <img
                                            src={`/storage/${image.path}`}
                                            alt={product.title}
                                        />
                                    </SwiperSlide>
                                ))}
                            </Swiper>

                        </div>

                        {/* Product family list */}

                        {product.family_products.length > 0 && (
                            <div className="product-family-list">
                                <h2>Family Product List</h2>
                                <div className="table-container">
                                    <table className="product-family-list-table">
                                        <thead>
                                            <tr>
                                                <th>Model No.</th>
                                                {product.family_products.some(dim => dim.power) && (
                                                    <th>Power</th>
                                                )}
                                                {product.family_products.some(dim => dim.slot) && (
                                                    <th>Slot</th>
                                                )}
                                                {product.family_products.some(dim => dim.dimensions_lwh) && (
                                                    <th>Dimensions <br />(L x W x H)</th>
                                                )}
                                                {product.family_products.some(dim => dim.dimensions_qh) && (
                                                    <th>Dimensions <br />(Ø x H)</th>
                                                )}
                                                {product.family_products.some(dim => dim.cut_hole_in_mm) && (
                                                    <th>Cut Hole in mm<br />(L x W)</th>
                                                )}
                                                {product.family_products.some(dim => dim.cut_hole_in_diameter) && (
                                                    <th>Cut Hole in <br />diameter (Ø)</th>
                                                )}
                                                {product.family_products.some(dim => dim.mounting_type) && (
                                                    <th>Mounting Type</th>
                                                )}
                                                {product.family_products.some(dim => dim.voltage) && (
                                                    <th>Voltage</th>
                                                )}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {product.family_products.map((dim) => (
                                                <tr key={dim.id}>
                                                    <td>{dim.model_number}</td>
                                                    {product.family_products.some(dim => dim.power) && (
                                                        <td>{dim.power}</td>
                                                    )}
                                                    {product.family_products.some(dim => dim.slot) && (
                                                        <td>{dim.slot}</td>
                                                    )}
                                                    {product.family_products.some(dim => dim.dimensions_lwh) && (
                                                        <td>{dim.dimensions_lwh}</td>
                                                    )}
                                                    {product.family_products.some(dim => dim.dimensions_qh) && (
                                                        <td>{dim.dimensions_qh}</td>
                                                    )}
                                                    {product.family_products.some(dim => dim.cut_hole_in_mm) && (
                                                        <td className='center'>{dim.cut_hole_in_mm}</td>
                                                    )}
                                                    {product.family_products.some(dim => dim.cut_hole_in_diameter) && (
                                                        <td className='center'>{dim.cut_hole_in_diameter}</td>
                                                    )}
                                                    {product.family_products.some(dim => dim.mounting_type) && (
                                                        <td>{dim.mounting_type}</td>
                                                    )}
                                                    {product.family_products.some(dim => dim.voltage) && (
                                                        <td>{dim.voltage}</td>
                                                    )}
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        )}
                    </div>


                    {/* Product Info */}
                    <div className="product-info">
                        <h1 className="product-title">{product.title} <span>{product.title_suffix}</span></h1>
                        <h2 className="product-model">{product.model_number} <span className='product-action-container-mobile'>
                            <ProductActions product={product} />
                        </span></h2>


                        {Object.entries(product.specifications).length > 0 && (
                            <div className="specs-section">
                                <div className="specs-title">Technical Operation & Electrical Data</div>
                                <div className="specs-grid">
                                    {Object.entries(product.specifications).map(([key, value]) => (
                                        <div key={key} className="spec-item">
                                            <p className="spec-key">{key}</p>
                                            <p className="spec-value">{value}</p>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        )}

                        <div className={` ${showMoreInfo ? 'product-others-infos' : ''}`}>

                            {/* Color Options */}
                            <div className="color-options">
                                <div className="options-grid">
                                    {product.colors.length > 0 && (
                                        <div className="color-section">
                                            <h3>Body Color Options</h3>
                                            <div className="color-choices">
                                                {product.colors.map((color) => (
                                                    <div key={color.id} className="color-choice">
                                                        <div className={`color-circle`} style={{ backgroundColor: color.code }}></div>
                                                        <span>{color.name}</span>
                                                    </div>
                                                ))}
                                            </div>
                                        </div>
                                    )}
                                    {product.reflector_colors.length > 0 && (
                                        <div className="color-section">
                                            <h3>Reflector Color Options</h3>
                                            <div className="reflector-color-choices-wrapper">
                                                <div className="color-choices reflector-color-choices" ref={reflectorContainerRef}>
                                                    {product.reflector_colors.map((reflectorColor) => (
                                                        <div key={reflectorColor.id} className="color-choice">
                                                            <img src={`/storage/${reflectorColor.thumbnail}`} alt={reflectorColor.name} />
                                                            <span>{reflectorColor.name}</span>
                                                        </div>
                                                    ))}
                                                </div>

                                                {product.reflector_colors.length > 2 && (
                                                    <button
                                                        className="reflector-scroll-btn"
                                                        onClick={(e) => {
                                                            e.stopPropagation();
                                                            e.preventDefault();
                                                            const container = reflectorContainerRef.current || document.querySelector('.reflector-color-choices');
                                                            if (container) {
                                                                const targetScrollLeft = reachedReflectorAtEnd
                                                                    ? container.scrollLeft - 210
                                                                    : container.scrollLeft + 210;

                                                                container.scrollTo({
                                                                    left: targetScrollLeft,
                                                                    behavior: 'smooth'
                                                                });
                                                            }
                                                        }}
                                                    >
                                                        {reachedReflectorAtEnd ? <LeftArrowLight /> : <RightArrowLight />}
                                                    </button>
                                                )}
                                            </div>
                                        </div>
                                    )}
                                </div>
                            </div>


                            {/* Dimension Options*/}
                            {product.dimension_options.length > 0 && (
                                <div className={`dimension-options ${product.dimension_options.length == 1 ? 'dimension-options-center' : ''}`}>
                                    <h3>Dimension Options</h3>
                                    <div className="dimension-grid">
                                        <div className="dimension-choices-wrapper">
                                            <div className="dimension-choices" ref={dimensionContainerRef}>
                                                {product.dimension_options.map((option) => (
                                                    <div key={option.id} className="dimension-choice">
                                                        <img
                                                            src={`/storage/${option.thumbnail}`}
                                                            alt={option.name}
                                                        />
                                                        <span>{option.name}</span>
                                                        <span className='dimension-diagram'><img src={`/storage/${option.diagram}`} alt={option.name} /></span>
                                                    </div>
                                                ))}
                                            </div>

                                            {product.dimension_options.length > 2 && (
                                                <button
                                                    className="dimension-scroll-btn"
                                                    onClick={(e) => {
                                                        e.stopPropagation();
                                                        e.preventDefault();
                                                        const container = dimensionContainerRef.current || document.querySelector('.dimension-choices');
                                                        if (container) {
                                                            const targetScrollLeft = reachedDimensionAtEnd
                                                                ? container.scrollLeft - 210
                                                                : container.scrollLeft + 210;

                                                            container.scrollTo({
                                                                left: targetScrollLeft,
                                                                behavior: 'smooth'
                                                            });
                                                        }
                                                    }}
                                                >
                                                    {reachedDimensionAtEnd ? <LeftArrowLight /> : <RightArrowLight />}
                                                </button>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            )}

                            {/* Installation Methods */}
                            {product.installation_methods.length > 0 && (
                                <div className="installation-methods">
                                    <h3>Installation Methods</h3>
                                    <div className="installation-grid">

                                        <div className="installation-choices">
                                            {product.installation_methods.map((method) => (
                                                <div key={method.id} className="installation-choice">
                                                    <span>{method.name}</span>
                                                    <img
                                                        src={`/storage/${method.thumbnail}`}
                                                        alt={method.name}
                                                    />
                                                </div>
                                            ))}
                                        </div>
                                    </div>
                                </div>
                            )}

                            {/* Accessories Options*/}
                            {product.accessories.length > 0 && (
                                <div className="accessories-options">
                                    <h3>Accessories</h3>
                                    <div className="accessories-grid">

                                        <div className="accessories-choices">
                                            {product.accessories.map((accessory) => (
                                                <div key={accessory.id} className="accessory-choice">
                                                    <img
                                                        src={`/storage/${accessory.thumbnail}`}
                                                        alt={accessory.name}
                                                    />
                                                    <span>{accessory.name}</span>
                                                </div>
                                            ))}
                                        </div>
                                    </div>
                                </div>
                            )}


                            {/* Product family list mobile */}

                            {product.family_products.length > 0 && (
                                <div className="product-family-list-mobile">
                                    <h2>Family Product List</h2>
                                    <div className="family-products-mobile-table-wrapper">
                                        <div className="family-products-mobile-table-container" ref={tableContainerRef}>
                                            <table className="family-product-mobile-table">
                                                <tbody>
                                                    <tr>
                                                        <th className="fixed-col">Model No.</th>
                                                        {product.family_products.map((familyProduct) => (
                                                            <td key={familyProduct.id}>{familyProduct.model_number}</td>
                                                        ))}
                                                    </tr>
                                                    {product.family_products.some(fp => fp.power) && (
                                                        <tr>
                                                            <th className="fixed-col">Power</th>
                                                            {product.family_products.map((familyProduct) => (
                                                                <td key={familyProduct.id}>{familyProduct.power || '-'}</td>
                                                            ))}
                                                        </tr>
                                                    )}
                                                    {product.family_products.some(fp => fp.slot) && (
                                                        <tr>
                                                            <th className="fixed-col">Slot</th>
                                                            {product.family_products.map((familyProduct) => (
                                                                <td key={familyProduct.id}>{familyProduct.slot || '-'}</td>
                                                            ))}
                                                        </tr>
                                                    )}
                                                    {product.family_products.some(fp => fp.dimensions_lwh) && (
                                                        <tr>
                                                            <th className="fixed-col">Dimensions (L x W x H)</th>
                                                            {product.family_products.map((familyProduct) => (
                                                                <td key={familyProduct.id}>{familyProduct.dimensions_lwh || '-'}</td>
                                                            ))}
                                                        </tr>
                                                    )}
                                                    {product.family_products.some(fp => fp.dimensions_qh) && (
                                                        <tr>
                                                            <th className="fixed-col">Dimensions (Ø x H)</th>
                                                            {product.family_products.map((familyProduct) => (
                                                                <td key={familyProduct.id}>{familyProduct.dimensions_qh || '-'}</td>
                                                            ))}
                                                        </tr>
                                                    )}
                                                    {product.family_products.some(fp => fp.cut_hole_in_mm) && (
                                                        <tr>
                                                            <th className="fixed-col">Cut Hole in mm (L x W)</th>
                                                            {product.family_products.map((familyProduct) => (
                                                                <td key={familyProduct.id}>{familyProduct.cut_hole_in_mm || '-'}</td>
                                                            ))}
                                                        </tr>
                                                    )}
                                                    {product.family_products.some(fp => fp.cut_hole_in_diameter) && (
                                                        <tr>
                                                            <th className="fixed-col">Cut Hole in diameter (Ø)</th>
                                                            {product.family_products.map((familyProduct) => (
                                                                <td key={familyProduct.id}>{familyProduct.cut_hole_in_diameter || '-'}</td>
                                                            ))}
                                                        </tr>
                                                    )}
                                                    {product.family_products.some(fp => fp.mounting_type) && (
                                                        <tr>
                                                            <th className="fixed-col">Mounting Type</th>
                                                            {product.family_products.map((familyProduct) => (
                                                                <td key={familyProduct.id}>{familyProduct.mounting_type || '-'}</td>
                                                            ))}
                                                        </tr>
                                                    )}
                                                    {product.family_products.some(fp => fp.voltage) && (
                                                        <tr>
                                                            <th className="fixed-col">Voltage</th>
                                                            {product.family_products.map((familyProduct) => (
                                                                <td key={familyProduct.id}>{familyProduct.voltage || '-'}</td>
                                                            ))}
                                                        </tr>
                                                    )}
                                                </tbody>
                                            </table>
                                        </div>

                                        {product.family_products.length > 1 && (
                                            <button
                                                className="family-table-scroll-btn"
                                                onClick={() => {
                                                    const container = document.querySelector('.family-products-mobile-table-container');
                                                    if (container) {
                                                        if (reachedAtEnd) {
                                                            // Scroll left by 65vw (one product width)
                                                            container.scrollLeft -= window.innerWidth * 0.55;
                                                        } else {
                                                            // Scroll right by 65vw (one product width)
                                                            container.scrollLeft += window.innerWidth * 0.55;
                                                        }
                                                    }
                                                }}
                                            >
                                                {reachedAtEnd ? <LeftArrowLight /> : <RightArrowLight />}
                                            </button>
                                        )}

                                    </div>
                                </div>
                            )}

                            {/* Download Buttons */}
                            <div className="download-buttons">
                                <a href={`/storage/${product.brochure}`} className="download-btn" download={`${product.model_number}_brochure.pdf`}>
                                    Download brochure
                                </a>
                                <a href={`/storage/${product.view_3d}`} className="download-btn" download={`${product.model_number}_3d_view.pdf`}>
                                    Download 3D view
                                </a>
                            </div>
                        </div>

                        {showMoreInfo && (
                            <div className="show-more-info-btn" onClick={() => setShowMoreInfo(!showMoreInfo)}>
                                <RightArrowLight />
                                <hr />
                                <span>See more details</span>
                            </div>
                        )}

                    </div>
                </div>

                {/* Related Products */}
                <div className="related-products">
                    <div className="container">
                        <h2>Related Products</h2>

                        <div className="swiper-container relative">
                            <Swiper
                                modules={[Navigation]}
                                spaceBetween={isMobile ? 30 : 65}
                                slidesPerView={isMobile ? 2.7 : 4}
                                breakpoints={{
                                    // when window width is >= 480px
                                    480: {
                                        slidesPerView: 2,
                                        spaceBetween: 30
                                    },
                                    // when window width is >= 768px
                                    768: {
                                        slidesPerView: 3,
                                        spaceBetween: 40
                                    },
                                    // when window width is >= 1024px
                                    1024: {
                                        slidesPerView: 4,
                                        spaceBetween: 60
                                    }
                                }}
                                pagination={{ clickable: true }}
                                className="related-products-slider"
                                onSwiper={setSwiper}
                            >
                                {product.relatedProducts.map((item) => (
                                    <SwiperSlide key={item.id}>
                                        <a href={`/products/${item.model_number}`}>
                                            <div className="related-products-product-card">
                                                <div className="related-products-product-card-image">
                                                    <img src={item.path} alt={item.title} />
                                                </div>
                                                <p>{item.model_number}
                                                    <span className="related-products-hover-bar"></span>
                                                </p>
                                            </div>
                                        </a>
                                    </SwiperSlide>
                                ))}
                            </Swiper>

                            {/* Custom Navigation Buttons */}
                            <div className="swiper-button-prev swiper-control-button" onClick={handlePrevClick}>
                                <LeftArrow />
                            </div>
                            <div className="swiper-button-next swiper-control-button" onClick={handleNextClick}>
                                <RightArrow />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </>
    );
};

export default ProductDetails; 