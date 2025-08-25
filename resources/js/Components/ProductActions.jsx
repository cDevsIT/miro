import { useRef, useState, useEffect } from 'react';
import ProductShare from '../../icons/ProductShare';
import WishlistIcon from '../../icons/Wishlist-icon-two'
import '../../css/product-actions.css';
import ShareTooltip from './ShareTooltip';
import LoginModal from './LoginModal';
import { useAuth } from '../hooks/useAuth';

const ProductActions = () => {
    const { isAuthenticated } = useAuth();
    const [showTooltip, setShowTooltip] = useState(false);
    const [showModal, setShowModal] = useState(false);
    const [tooltipPosition, setTooltipPosition] = useState({ x: 0, y: 0 });
    const shareIconRef = useRef(null);
    const tooltipRef = useRef(null);
    const wishlistIconRef = useRef(null);

    // Handle click outside to close tooltip
    useEffect(() => {
        const handleClickOutside = (event) => {
            if (showTooltip && 
                tooltipRef.current && 
                !tooltipRef.current.contains(event.target) &&
                shareIconRef.current && 
                !shareIconRef.current.contains(event.target)) {
                setShowTooltip(false);
            }
        };

        document.addEventListener('mousedown', handleClickOutside);
        return () => {
            document.removeEventListener('mousedown', handleClickOutside);
        };
    }, [showTooltip]);

    const handleShareClick = (e) => {
        e.stopPropagation();
        if (shareIconRef.current) {
            const rect = shareIconRef.current.getBoundingClientRect();
            const tooltipWidth = 200; // Approximate tooltip width
            const viewportWidth = window.innerWidth;

            // Calculate optimal position
            let x = rect.left + (rect.width / 2);
            let y = rect.bottom + 8;

            // Adjust if tooltip would go off-screen to the right
            if (x + tooltipWidth / 2 > viewportWidth - 20) {
                x = viewportWidth - tooltipWidth / 2 - 20;
            }

            // Adjust if tooltip would go off-screen to the left
            if (x - tooltipWidth / 2 < 20) {
                x = tooltipWidth / 2 + 20;
            }

            setTooltipPosition({ x, y });
        }
        setShowTooltip(!showTooltip);
    };

    const handleWishlistClick = (e) => {
        e.stopPropagation();
        setShowTooltip(false); // Close tooltip if open
        if (!isAuthenticated) {
            setShowModal(true);
        } else {
            // Handle authenticated user wishlist action
            console.log('User is authenticated, handle wishlist action');
        }
    }

    const handleTooltipClose = () => {
        setShowTooltip(false);
    };

    const handleModalClose = () => {
        setShowModal(false);
    };

    return (
        <div className='product-details-actions'>
            {/* Wishlist Icon  */}
            <div 
                ref={wishlistIconRef}
                className='product-actions-icon' 
                onClick={handleWishlistClick}
            >
                <WishlistIcon />
            </div>
            {/* Share Icon */}
            <div ref={shareIconRef}
                className="product-actions-share-icon"
                onClick={handleShareClick}>
                <ProductShare />
                <ShareTooltip 
                    ref={tooltipRef}
                    show={showTooltip}
                    position={tooltipPosition}
                    onClose={handleTooltipClose}
                />
            </div>

            <LoginModal
                show={showModal}
                onClose={handleModalClose}
            />
        </div>
    );
};

export default ProductActions;