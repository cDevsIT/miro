import { createRoot } from 'react-dom/client';
import BestSeller from './Components/BestSeller';

// Create root and render
const container = document.getElementById('best-seller-carousel');
if (container) {
    const root = createRoot(container);
    root.render(<BestSeller />);
} 