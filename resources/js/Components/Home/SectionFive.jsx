import React, { useState, useRef, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

import RightArrow from '../../../icons/arrow-right.jsx';
import LeftArrow from '../../../icons/arrow-left.jsx';


const products = [
    {
        id: 1,
        name: "Modular Recessed",
        image: "/images/miro-carousel-1.jpg"
    },
    {
        id: 2,
        name: "Adjustable Recessed",
        image: "/images/miro-carousel-2.jpg"
    },
    {
        id: 3,
        name: "Surface Mounted",
        image: "/images/miro-carousel-3.jpg"
    },
    {
        id: 4,
        name: "Stable Surface Mounted",
        image: "/images/miro-carousel-4.jpg"
    },
    {
        id: 5,
        name: "Surface Adjustable Recessed",
        image: "/images/miro-carousel-5.jpg"
    },
    {
        id: 6,
        name: "Surface Panel",
        image: "/images/miro-carousel-6.jpg"
    },

];

const SectionFive = () => {
    const sliderRef = useRef(null);
    const [isDragging, setIsDragging] = useState(false);
    const [startX, setStartX] = useState(0);
    const [scrollLeft, setScrollLeft] = useState(0);
    const [dragStartTime, setDragStartTime] = useState(0);
    const [dragEndTime, setDragEndTime] = useState(0);
    const [dragDistance, setDragDistance] = useState(0);
    const [swiper, setSwiper] = useState(null);
    const [isMobile, setIsMobile] = useState(window.innerWidth < 768);


        // Check if device is mobile
        useEffect(() => {
            const handleResize = () => {
                setIsMobile(window.innerWidth < 768);
            };
    
            window.addEventListener('resize', handleResize);
            return () => window.removeEventListener('resize', handleResize);
        }, []);


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

    const startDragging = (e) => {
        setIsDragging(true);
        setStartX(e.pageX - (sliderRef.current?.offsetLeft || 0));
        setScrollLeft(sliderRef.current?.scrollLeft || 0);
        setDragStartTime(Date.now());
        setDragDistance(0);
    };

    const stopDragging = () => {
        if (isDragging) {
            setIsDragging(false);
            setDragEndTime(Date.now());

            const timeElapsed = dragEndTime - dragStartTime;
            const velocity = dragDistance / timeElapsed;

            if (Math.abs(velocity) > 0.5 && sliderRef.current) {
                const momentum = velocity * 100;
                sliderRef.current.scrollBy({
                    left: -momentum,
                    behavior: 'smooth'
                });
            }
        }
    };

    const onDrag = (e) => {
        if (!isDragging) return;
        e.preventDefault();

        const x = e.pageX - (sliderRef.current?.offsetLeft || 0);
        const walk = (x - startX) * 1.5;
        setDragDistance(walk);

        if (sliderRef.current) {
            sliderRef.current.scrollLeft = scrollLeft - walk;
        }
    };

    const scroll = (direction) => {
        if (sliderRef.current) {
            const scrollAmount = direction === 'left' ? -400 : 400;
            sliderRef.current.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        }
    };

    useEffect(() => {
        const slider = sliderRef.current;
        if (!slider) return;

        const handleMouseUp = () => {
            stopDragging();
        };

        window.addEventListener('mouseup', handleMouseUp);
        return () => window.removeEventListener('mouseup', handleMouseUp);
    }, [isDragging, dragDistance, dragStartTime]);

    return (
        <div className="section-five-container container-left-offset">
            <div className="section-five-header">
                <div className="section-five-title">
                    <h2>Best Seller</h2>
                    <p>Explore our latest lighting solutions, combining innovative design with exceptional quality.
                        Illuminate your space with fresh styles that inspire and transform.</p>
                </div>
                <div className="section-five-controls">
                    <button onClick={() => scroll('left')} className="section-five-control-button">
                        <LeftArrow />
                    </button>
                    <button onClick={() => scroll('right')} className="section-five-control-button">
                        <RightArrow />
                    </button>
                </div>
            </div>


{/* 
                    <div className="swiper-container relative">
                        <Swiper
                            modules={[Navigation]}
                            spaceBetween={isMobile ? 30 : 60}
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
                            {products.map((product) => (
                                <SwiperSlide key={product.name}>
                                    <div className="related-products-product-card">
                                        <div className="related-products-product-card-image">
                                            <img src={product.image} alt={product.name} />
                                        </div>
                                        <p>{product.name}
                                            <span className="related-products-hover-bar"></span>
                                        </p>
                                    </div>
                                </SwiperSlide>
                            ))}
                        </Swiper>
                        
                        {/* Custom Navigation Buttons */}
                        {/* <div className="swiper-button-prev swiper-control-button" onClick={handlePrevClick}>
                            <LeftArrow />
                        </div>
                        <div className="swiper-button-next swiper-control-button" onClick={handleNextClick}>
                            <RightArrow />
                        </div>
                    </div> */}
 



            <div
                ref={sliderRef}
                className="section-five-content"
                onMouseDown={startDragging}
                onMouseLeave={stopDragging}
                onMouseUp={stopDragging}
                onMouseMove={onDrag}
            >
                {products.map((product) => (
                    <div key={product.id} className="section-five-item">
                        <div className="section-five-product-wrapper">
                            <div className="section-five-image-container">
                                <img src={product.image} alt={product.name} />
                            </div>
                            <div className="section-five-title-container">
                                <h3>{product.name}</h3>
                                <div className="section-five-hover-bar"></div>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default SectionFive;