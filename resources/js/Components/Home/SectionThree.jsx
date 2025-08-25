import React, { useRef, useState } from 'react';

const images = [
    {
        url: '/images/miro-selection-1.jpg',
        title: 'Adjustable Surface Mounted'
    },
    {
        url: '/images/miro-selection-2.jpg',
        title: 'Non-Adjustable Surface Mounted'
    },
    {
        url: '/images/miro-selection-3.jpg',
        title: 'Wire Track Luminaire'
    }
];
const SectionThree = () => {
    const sliderRef = useRef(null);
    const [isDragging, setIsDragging] = useState(false);
    const [startX, setStartX] = useState(0);
    const [scrollLeft, setScrollLeft] = useState(0);

    const handleMouseDown = (e) => {
        setIsDragging(true);
        if (sliderRef.current) {
            setStartX(e.pageX - sliderRef.current.offsetLeft);
            setScrollLeft(sliderRef.current.scrollLeft);
        }
    };

    const handleMouseUp = () => {
        setIsDragging(false);
    };

    const handleMouseMove = (e) => {
        if (!isDragging) return;
        e.preventDefault();
        if (sliderRef.current) {
            const x = e.pageX - sliderRef.current.offsetLeft;
            const walk = (x - startX);
            sliderRef.current.scrollLeft = scrollLeft - walk;
        }
    };
    return (
        <section className="section-three-gallery-container container">
            <h2 className="section-three-gallery-title">Miro Selection</h2>
            <p className="section-three-gallery-subtitle">Handpicked products for unparalleled lighting experiences</p>
            <div
                ref={sliderRef}
                className="section-three-image-grid"
                onMouseDown={handleMouseDown}
                onMouseUp={handleMouseUp}
                onMouseLeave={handleMouseUp}
                onMouseMove={handleMouseMove}
            >
                {images.map((image, index) => (
                    <div key={index} className="section-three-image-card">
                        <div className="section-three-image-wrapper">
                            <img src={image.url} alt={image.title} draggable="false" />
                        </div>
                        <div className="section-three-image-title">
                            <h3>{image.title}</h3>
                            <div className="section-three-hover-bar"></div>
                        </div>
                    </div>
                ))}
            </div>
        </section>
    );
};

export default SectionThree;