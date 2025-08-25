import React, { useState, useEffect } from 'react';
import { useAuth } from '../hooks/useAuth';
import axios from 'axios';
import DatePicker from 'react-datepicker';
import 'react-datepicker/dist/react-datepicker.css';

import img1 from "../../../public/images/services/miro-services.jpg";
import img2 from "../../../public/images/services/Light-Design-Consultancy.jpg";
import img3 from "../../../public/images/services/Light-Supply.jpg";
import img4 from "../../../public/images/services/Light-Installation.jpg";
import img5 from "../../../public/images/services/Book-appointment.jpg";
import img6 from "../../../public/images/services/book-an-appoinment.jpg";
import LightDesignConsultancyIcon from '../../icons/light-design-const';
import LightSupplyIcon from '../../icons/light-supply';
import LightInstallationIcon from '../../icons/light-installation';
import '../../css/services.css';

const Services = () => {
    const { isAuthenticated } = useAuth();
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        phone: '',
        date: '',
        time: '',
        remarks: ''
    });
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState('');
    const [success, setSuccess] = useState(false);

    // Set current time when component loads or date changes
    useEffect(() => {
        if (formData.date) {
            const now = new Date();
            const currentTime = now.toLocaleTimeString('en-US', {
                hour12: false,
                hour: '2-digit',
                minute: '2-digit'
            });
            setFormData(prev => ({ ...prev, time: currentTime }));
        }
    }, [formData.date]);

    // Auto-hide success message after 20 seconds
    useEffect(() => {
        let timer;
        if (success) {
            timer = setTimeout(() => {
                setSuccess(false);
            }, 10000); // 10 seconds
        }
        return () => {
            if (timer) clearTimeout(timer);
        };
    }, [success]);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setError('');
        setSuccess(false);

        // Ensure time is set to current time if not already set
        if (!formData.time) {
            const now = new Date();
            const currentTime = now.toLocaleTimeString('en-US', {
                hour12: false,
                hour: '2-digit',
                minute: '2-digit'
            });
            formData.time = currentTime;
        }

        try {
            const response = await axios.post('/mymiro/appointments/store', formData);

            if (response.data.success) {
                setSuccess(true);
                // Reset form
                setFormData({
                    name: '',
                    email: '',
                    phone: '',
                    date: '',
                    time: '',
                    remarks: ''
                });
            }
        } catch (err) {
            console.error('Appointment booking error:', err);
            setError(err.response?.data?.message || 'Failed to book appointment. Please try again.');
        } finally {
            setLoading(false);
        }
    };

    return (
        <>
            <div className="services-container">
                <div className="services-image-container">
                    <img src={img1} alt="Service Image" className="service-image" />
                </div>
                <div className="service-content">
                    <div className="content-center container">
                        <div className="service-heading">
                            <h1>Light is not just illumination, it's the art of transforming spaces, setting moods, and inspiring moments.</h1>
                        </div>
                        <div className="service-description">
                            <p>Miro Lighting Solutions delivers end-to-end lighting services, blending design, supply, and installation with innovative technology to illuminate spaces beautifully and efficiently.</p>

                            <p>Miro Lighting Solutions delivers custom lighting designs that combine functionality and style. From high-quality fixtures and custom solutions to seamless installations and home automation systems, they ensure effortless control and client satisfaction with every project.</p>
                        </div>
                    </div>
                    <div className="line-at-bottom"></div>
                </div>
            </div>

            {/* Our Services SECTION */}
            <div className="our-services-section container">
                <h2 className="our-services-heading">Our Services</h2>
                <p className="our-services-subheading">
                    Miro Lighting Solutions offers high-quality, energy-efficient lighting products, customized lighting design services, and reliable supply solutions for residential, commercial, and industrial projects.
                </p>

                {/* Cards */}
                <div className="card-container">
                    {/* Card 1 */}
                    <div className="service-card">
                        <div className="card-icon-div card-icon1">
                            <LightDesignConsultancyIcon/>
                        </div>
                        <h3 className="card-heading">Light Design Consultancy</h3>
                        <div className="card-border"></div>
                        <p className="card-description">
                            Miro Lighting Solutions delivers personalized lighting designs that seamlessly combine aesthetics, functionality, and innovation to create the perfect ambiance for any space.
                        </p>
                        <div className="learn-more-link"><a href="#light-design-consultancy">Learn More</a></div>
                    </div>

                    {/* Card 2 */}
                    <div className="service-card">
                        <div className="card-icon-div card-icon2">
                            <LightSupplyIcon/>
                        </div>
                        <h3 className="card-heading">Light Supply</h3>
                        <div className="card-border"></div>
                        <p className="card-description">
                            Miro Lighting Solutions supplies a diverse range of high-quality, energy-efficient lighting products, tailored to meet the unique needs of residential, commercial, and industrial projects.
                        </p>
                        <div className="learn-more-link"><a href="#light-supply">Learn More</a></div>
                    </div>

                    {/* Card 3 */}
                    <div className="service-card">
                        <div className="card-icon-div card-icon3">
                            <LightInstallationIcon/>
                        </div>
                        <h3 className="card-heading">Light Installation</h3>
                        <div className="card-border"></div>
                        <p className="card-description">
                            Miro Lighting Solutions delivers personalized lighting designs that seamlessly combine aesthetics, functionality, and innovation to create the perfect ambiance for any space.
                        </p>
                        <div className="learn-more-link"><a href="#light-installation">Learn More</a></div>
                    </div>
                </div>
            </div>

            {/* Light Design Consultancy Section */}
            <div className="section-container container-left-offset" id="light-design-consultancy">
                <div className="content-container">
                    {/* Left Image Section */}
                    <div className="image-container-2">
                        <img src={img2} alt="Light Design Consultancy" className="service-image" />
                    </div>

                    {/* Right Text Section */}
                    <div className="text-container">
                        {/* Heading and Subheading */}
                        <div className="heading-container">
                            <h2>
                                Light Design Consultancy
                            </h2>
                        </div>

                        {/* Description */}
                        <div className="description-container">

                            <p>Miro Lighting Solutions offers personalized lighting design consultancy, customizing each project to match the client's taste, style, and aesthetic vision. With expert guidance, Miro provides the best solutions for both interior and exterior lighting, ensuring seamless integration with the project's goals while prioritizing sustainability.</p>
                            <p>Beyond consultancy, Miro crafts custom offers, helping clients and designers blend styles effortlessly to create exceptional, vibrant spaces. Filling a unique gap in the market, Miro transforms lighting into an art form, enhancing both functionality and beauty for every project.</p>

                        </div>
                    </div>
                </div>
            </div>

            {/* Light Bulb Design */}

            
            <div id="light-supply">
            <div className="light-bulb-section container-right-offset">
                <div className="bulb-text-container">
                    {/* Heading and Subheading */}
                    <div className="bulb-heading-container">
                        <h2>
                            Light Supply
                        </h2>
                    </div>

                    {/* Description */}
                    <div className="bulb-description-container">
                        <p>
                        Miro Lighting Solutions prides itself on exceptional customer service, ensuring a seamless experience from consultation to delivery. With a fast and reliable supply chain, Miro delivers lighting products within 45 to 60 days after pre-order, faster than any other lighting store in the market. Their dedicated support team is always ready to assist clients, offering personalized advice, tracking orders, and ensuring timely, safe delivery. Miro's commitment to quality and customer satisfaction ensures that every project receives the best lighting solutions, with the highest standards of durability and care.
                        </p>
                    </div>
                </div>

                <div className="column-two">
                    <img src={img3} alt="Light Supply Image" className="light-bulb-image" />
                </div>

            </div>
            </div>

            {/* Light Installation Design */}


            <div className="section-container container-left-offset" id="light-installation">
                <div className="content-container">
                    {/* Left Image Section */}
                    <div className="image-container-2">
                        <img src={img4} alt="Light Design Consultancy" className="install-service-image" />
                    </div>

                    {/* Right Text Section */}
                    <div className="text-container">
                        {/* Heading and Subheading */}
                        <div className="heading-container">
                            <h2>
                                Light Installation
                            </h2>
                        </div>

                        {/* Description */}
                        <div className="description-container">

                            <p>Miro Lighting Solutions offers expert light installation services that blend precision, safety, and functionality. Their skilled team oversees every step of the process, ensuring fixtures are expertly positioned, securely mounted, and wired for peak performance. </p>

                            <p>Going beyond traditional contractors, Miro's lighting architects and advisors visit each site to provide hands-on guidance, ensuring the lighting aligns perfectly with the space's unique requirements. By considering natural light, room layout, and intended use, Miro delivers flawless illumination that enhances both the environment and functionality of every project.</p>

                        </div>
                    </div>
                </div>
            </div>

            

            {/* Image for Employee working together */}

            <div className="work-img-box">
                <img src={img5} alt="Light Design Consultancy" className="work-img" />
            </div>

            {/* Text for Employee working together */}

            <div className="work-text container">
                Miro Lighting Solutions goes beyond simply providing lighting products, it offers a complete, client-focused experience. With a dedicated team that prioritizes personalized solutions, Miro combines expert advice, innovative designs, and tailored services to create lighting that enhances both the project and the client's vision. Miro isn't just about selling lights; it's about delivering thoughtful, transformative solutions that truly make a difference.
            </div>

            {/* Form for Apppointment */}

            <div className="appointment-heading">
                Book an appointment
            </div>
            {isAuthenticated ? (
            <div className="appointment-form-content">
                <div className="form-container">
                    {error && (
                        <div className="error-message">
                            {error}
                        </div>
                    )}
                    {success && (
                        <div className="success-message">
                            Your appointment has been booked successfully! <br/> You can check your appointment details at <a href="/mymiro" onClick={(e) => {
                                e.preventDefault();
                                window.location.href = '/mymiro';
                                // Set activeTab in localStorage to be read by MyMiro component
                                localStorage.setItem('mymiroActiveTab', 'meetingSchedule');
                            }}>MyMiro Dashboard</a>.
                        </div>
                    )}
                    <form className="form" onSubmit={handleSubmit}>
                        <div className="form-group">
                            <input 
                                type="text" 
                                id="name" 
                                placeholder="Name" 
                                className="form-input"
                                value={formData.name}
                                onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                                required
                            />
                            <input 
                                type="email" 
                                id="email" 
                                placeholder="Email" 
                                className="form-input"
                                value={formData.email}
                                onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                                required
                            />
                        </div>
                        <div className="form-group">
                            <input 
                                type="tel" 
                                id="phone" 
                                placeholder="Phone" 
                                className="form-input"
                                value={formData.phone}
                                onChange={(e) => setFormData({ ...formData, phone: e.target.value })}
                                required
                            />
                            <DatePicker
                                selected={formData.date ? new Date(formData.date) : null}
                                onChange={(date) => setFormData({ ...formData, date: date.toISOString().split('T')[0] })}
                                placeholderText="Pick a date"
                                minDate={new Date()}
                                className="form-input"
                                required
                            />
                        </div>
                        <div className="form-group">
                            <textarea 
                                id="remarks" 
                                placeholder="Remarks" 
                                className="textarea"
                                value={formData.remarks}
                                onChange={(e) => setFormData({ ...formData, remarks: e.target.value })}
                            ></textarea>
                        </div>
                        <div className="button-form-group">
                            <button 
                                type="submit" 
                                className="submit-button"
                                disabled={loading}
                            >
                                {loading ? 'Submitting...' : 'SUBMIT'}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            ) : (
                <div className="appointment-without-login-content">
                    <div className="appointment-without-login-text">
                        <h2>Please sign in to proceed with your booking!</h2>
                        <p>You must log in to book an appointment.<br/> Sign in or create an account to proceed<br/> and manage your bookings easily.</p>
                        <a href="/mymiro/login" className="appointment-without-login-button">Get Started</a>
                    </div>
                    <div className="appointment-without-login-img">
                        <img src={img6} alt="Book an appointment" />
                    </div>
                </div>
            )}
        </>
    );
};

export default Services;
