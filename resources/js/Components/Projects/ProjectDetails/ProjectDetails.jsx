import '../../../../css/ProjectDetails.css'
import ProjectDetailsBenefits from './ProjectDetailsBenefits'
import ShareIcon from '../../../../icons/share'
import projectDetails06 from '../../../../../public/images/project-details-06.jpg'
import projectDetails02 from '../../../../../public/images/project-details-02.jpg'


const projectDetailsBenefits = {
    title: 'Miro Lighting for BRAC Daycare',
    description: 'Creating a comfortable and nurturing environment for children starts with thoughtful lighting design. Enhanced natural light, carefully designed to mimic daylight, fosters a welcoming and calming atmosphere that supports children\'s well-being. Energy efficiency is also a priority, with reliable luminaires that provide optimal brightness while conserving energy. These durable, long-lasting lights reduce the need for frequent maintenance, ensuring consistent performance over time. Above all, the lighting is tailored with children in mind—safe, adjustable, and designed to inspire learning, play, and growth in an environment where they can truly thrive.',
    image: '/images/project-details-03.jpg'
}

const projectBrightBeginings = {
    title: 'Bright Beginnings with Miro',
    description: 'Miro Lighting Solutions has elevated the BRAC University Daycare Center with a thoughtfully designed lighting system that prioritizes safety, comfort, and energy efficiency. By replicating natural daylight, the lighting enhances the environment, fostering a space where children can play, learn, and grow. With durable, high-performance fixtures, Miro ensures long-lasting illumination, creating an inspiring and nurturing atmosphere following to the needs of young learners.',
    image: '/images/project-details-07.jpg'
}

function ProjectDetails() {
    return (
        <>
            <div className="project-details-container">
                <div className="project-details-header">
                    <img
                        src="/images/project-details-main-picture.jpg"
                        alt="BRAC University Day Care"
                        className="project-details-image"
                    />


                </div>

                <div className="project-details-content container">
                    <div className="project-details-content-left">
                        <div className="project-details-share">
                            <span className="project-details-share-icon-title">
                                <ShareIcon />
                                <span>Share this project</span>
                            </span>
                            <div className="project-details-share-icons">
                                <img src="/images/icons/EMAIL-LOGO.svg" alt="Email" className="project-details-share-icon" />
                                <img src="/images/icons/FACEBOOK-LOGO.svg" alt="Facebook" className="project-details-share-icon" />
                                <img src="/images/icons/INSTRAGRAM-LOGO.svg" alt="Instagram" className="project-details-share-icon project-details-instagram-icon" />
                                <img src="/images/icons/LINKDIN-LOGO.svg" alt="LinkedIn" className="project-details-share-icon" />
                            </div>
                        </div>
                        <h1 className="project-details-title">BRAC University Day Care</h1>
                        <div className="project-details-info">
                            <div className="project-details-info-item">
                                <span className="project-details-info-label">
                                    <img src="/images/icons/LOCATION.svg" alt="LinkedIn" className="project-details-share-icon" />
                                    <p>Location:</p>
                                </span>
                                <span>Badda, Dhaka, Bangladesh</span>
                            </div>
                            <div className="project-details-info-item">
                                <span className="project-details-info-label">
                                    <img src="/images/icons/CLIENT.svg" alt="LinkedIn" className="project-details-share-icon" />
                                    <p>Client:</p>
                                </span>
                                <span>BRAC University</span>
                            </div>
                            <div className="project-details-info-item">
                                <span className="project-details-info-label">
                                    <img src="/images/icons/CALENDER.svg" alt="LinkedIn" className="project-details-share-icon" />
                                    <p>Year:</p>
                                </span>
                                <span>2024</span>
                            </div>
                            <div className="project-details-info-item">
                                <span className="project-details-info-label">
                                    <img src="/images/icons/CAMERA.svg" alt="LinkedIn" className="project-details-share-icon" />
                                    <p>Photographs:</p>
                                </span>
                                <span>Alvi Muhtasim</span>
                            </div>
                        </div>
                    </div>

                    <div className="project-details-description-container">
                        <h2>Lighting Dreams, Inspiring Growth</h2>
                        <p className="project-details-description">
                            In 2024, Miro Lighting Solutions designed and implemented the lighting system
                            for BRAC University Daycare Center, creating a vibrant, child-friendly environment.
                            The primary objective was to replicate the natural daylight ambiance, crucial for
                            children's comfort and well-being.
                        </p>
                    </div>
                </div>
            </div>

            <div className="project-details-concept">
                <div className="project-details-concept-container container">
                    <div className="project-details-concept-text">
                        <h2 className="project-details-concept-title">Lighting Concept and Execution</h2>
                        <p className="project-details-concept-description">
                        To achieve a daylight-inspired effect, 6000k lighting solutions were utilized, ensuring omni-directional illumination and a natural glow throughout the space. The design prioritized safety, aesthetics, and energy efficiency while supporting the activities of children in a well-lit environment.
                        </p>
                    </div>
                    <img
                    src={projectDetails02}
                        className="project-details-concept-image"
                    />
                </div>
            </div>


            <ProjectDetailsBenefits data={projectDetailsBenefits} />
            <div className="container">
                <div className="project-details-climbing-grid">

                    <img
                        src="/images/project-details-04.jpg"
                        alt="Climbing wall with LED holds"
                        className="project-details-climbing-image"
                    />
                    <img
                        src="/images/project-details-05.jpg"
                        alt="Geometric wall patterns"
                        className="project-details-climbing-image"
                    />
                </div>
            </div>
            <div className="project-details-concept">
                <div className="project-details-concept-container container">
                    <div className="project-details-concept-text">
                        <h2 className="project-details-concept-title">Light used for the project</h2>
                        <p className="project-details-concept-description">
                        The BRAC University Daycare Center features thoughtfully selected lighting solutions to create a safe, vibrant, and energy-efficient environment. <br/> <span>Panel lights <strong>(MIR-P404A1001)</strong></span> are used for their versatility, high CRI, and long lifespan, offering seamless installation options for recessed or surface mounting. <span>Spotlights <strong>(MIR-ST410A7001)</strong></span> complement the design with their compact form, allowing easy integration with the architecture, and adjustable functionality for custom indoor lighting needs.<br/> Additionally, <strong>4000K strip</strong> lights deliver efficient, reliable illumination with a high CRI&gt;97 and durability, making them suitable for diverse applications across the daycare center.
                        </p>
                    </div>
                    <img
                    src={projectDetails06}
                        className="project-details-concept-image"
                    />
                </div>
            </div>
            <ProjectDetailsBenefits data={projectBrightBeginings} />
        </>
    )
}

export default ProjectDetails