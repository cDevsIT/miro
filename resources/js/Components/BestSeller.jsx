import { useState, useRef } from 'react';

const BestSeller = () => {
    const carouselRef = useRef(null);
    const [canScrollLeft, setCanScrollLeft] = useState(false);
    const [canScrollRight, setCanScrollRight] = useState(true);

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
        }
    ];

    const checkScroll = () => {
        if (carouselRef.current) {
            const { scrollLeft, scrollWidth, clientWidth } = carouselRef.current;
            setCanScrollLeft(scrollLeft > 0);
            setCanScrollRight(scrollLeft < scrollWidth - clientWidth - 10);
        }
    };

    const scroll = (direction) => {
        if (carouselRef.current) {
            const scrollAmount = 340; // Width of item + gap
            carouselRef.current.scrollBy({
                left: direction === 'left' ? -scrollAmount : scrollAmount,
                behavior: 'smooth'
            });
        }
    };

    return (
        <div className="carousel-container">
            <div className="carousel-nav">
                <button 
                    className="carousel-nav-button"
                    onClick={() => scroll('left')}
                    style={{ opacity: canScrollLeft ? 1 : 0.5 }}
                >
                    ←
                </button>
                <button 
                    className="carousel-nav-button"
                    onClick={() => scroll('right')}
                    style={{ opacity: canScrollRight ? 1 : 0.5 }}
                >
                    →
                </button>
            </div>
            
            <div 
                className="home-carousel"
                ref={carouselRef}
                onScroll={checkScroll}
            >
                {products.map((product) => (
                    <div key={product.id} className="home-carousel-item">
                        <img 
                            src={product.image} 
                            alt={product.name}
                        />
                        <h3>{product.name}</h3>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default BestSeller; 