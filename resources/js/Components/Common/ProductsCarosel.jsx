import React, { useState, useRef, useEffect } from 'react';

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