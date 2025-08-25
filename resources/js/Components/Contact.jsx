import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useAuth } from '../hooks/useAuth';

const Contact = () => {
    const { isAuthenticated } = useAuth();
    const [formData, setFormData] = useState({
        subject: '',
        message: ''
    });
    const [isSubmitting, setIsSubmitting] = useState(false);
    const [submitStatus, setSubmitStatus] = useState(null);

    // Effect to clear submit status after 3 seconds
    useEffect(() => {
        if (submitStatus) {
            const timer = setTimeout(() => {
                setSubmitStatus(null);
            }, 3000);
            return () => clearTimeout(timer);
        }
    }, [submitStatus]);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: value
        }));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setIsSubmitting(true);
        try {
            const response = await axios.post('/api/messages', formData);
            setSubmitStatus({ type: 'success', message: 'Message sent successfully!' });
            setFormData({ subject: '', message: '' });
        } catch (error) {
            setSubmitStatus({ type: 'error', message: 'Failed to send message. Please try again.' });
        }
        setIsSubmitting(false);
    };

    return (
        <div className="contact-page container">
            <div className="contact-grid">
                {/* Left Side - Image and Info */}
                <div className="contact-info">
                    <div className="contact-image">
                        <img src="/images/alvi.png" alt="Contact Us" />
                        <div className="contact-text-lets-collaborate">
                            <h2>Let's Collaborate</h2>
                            <h3>Get in Touch Today!</h3>
                            <div className="contact-details">
                                <a href="tel:01786711975">Phone No: +8801786-711975</a>
                                <a href="mailto:info@miro-lightingsolutions.com">Email: info@miro-lightingsolutions.com</a>
                            </div>
                        </div>
                        <div className="contact-overlay"></div>
                    </div>
                    <div className="contact-text">
                        <p>Light up your interiors with brilliance and sophistication.</p>
                        <p>Because at Miro, every detail matters!</p>
                    </div>
                    
                </div>

                {/* Right Side - Form or Get Started */}
                <div className={`contact-action ${isAuthenticated ? 'contact-action-authenticated' : ''}`}>
                    <h2>Get in Touch with US!</h2>
                    {isAuthenticated ? (
                        <>
                            <p className="contact-description">
                                We're here to assist you; book an appointment, ask questions, or share your needs.<br/>
                                Let's connect!"
                            </p>
                            <form onSubmit={handleSubmit} className="contact-form">
                                {submitStatus && (
                                    <div className={`submit-status ${submitStatus.type}`}>
                                        {submitStatus.message}
                                    </div>
                                )}
                                <div className="form-group">
                                    <input
                                        type="text"
                                        name="subject"
                                        placeholder="Subject"
                                        value={formData.subject}
                                        onChange={handleChange}
                                        required
                                    />
                                </div>
                                <div className="form-group">
                                    <textarea
                                        name="message"
                                        placeholder="Type your message here"
                                        value={formData.message}
                                        onChange={handleChange}
                                        required
                                    ></textarea>
                                </div>
                                <button 
                                    type="submit" 
                                    className="submit-button"
                                    disabled={isSubmitting}
                                >
                                    {isSubmitting ? 'Sending...' : 'SUBMIT'}
                                </button>
                            </form>
                        </>
                    ) : (
                        <>
                            <p className="contact-description">
                                We're here to assist you; Please log in to book an appointment, 
                                ask questions, or share your needs. <br/> Let's connect!"
                            </p>
                            <a href={`/mymiro/login?returnUrl=${encodeURIComponent(window.location.pathname)}`} className="get-started-button">
                                Get Started
                            </a>
                        </>
                    )}
                </div>
            </div>
        </div>
    );
};

export default Contact; 