import React from 'react';
import '../../../css/Project.css';

const projects = [
    {
        id: 1,
        title: "RADIANT DENTAL CLINIC",
        location: "Mohakhali DOHS, Dhaka",
        image: "/images/DEMO-2ND-PROJECT.jpg"
    },
    {
        id: 2,
        title: "AKHLAQ RESIDENCE",
        location: "Baridhara, Dhaka",
        image: "/images/DEMO-3RD-PROJECT.jpg"

    },
    {
        id: 3,
        title: "KHAN FARMS",
        location: "Manikganj, Dhaka",
        image: "/images/DEMO-4TH-PICTURE.jpg"

    },
    {
        id: 4,
        title: "Dr. SHAYLA RESIDENCE",
        location: "Mohakhali DOHS, Dhaka",
        image: "/images/DEMO-5TH-PICTURE.jpg"

    }
];

function Project() {
    return (
        <div>
            <div className="project-page-container">
                <div className="project-page-content">
                    <div className="project-page-image">
                        <div className="project-page-image-wrapper">
                            <img
                                src="/images/1ST-PROJECT.jpg"
                                alt="BRAC University Day Care"
                            />
                        </div>
                    </div>
                    <div className="project-page-text">
                        <h1 className="project-page-title">BRAC University Day Care</h1>
                        <p className="project-page-location">Badda, Dhaka</p>
                        <p className="project-page-description">
                            Mira Lighting Solutions transformed the BRAC University Day Care into a bright and inviting space, perfectly
                            designed for children. By incorporating child-friendly and efficient lighting, we ensured safety, optimal
                            brightness, and a playful yet cozy ambiance. Durable, energy-efficient fixtures were carefully selected to
                            enhance the environment, creating a well-lit haven where children can learn, play, and grow with comfort
                            and confidence.
                        </p>
                        <a href="/projects/1" className="project-page-button">
                            Learn more
                        </a>
                    </div>
                </div>
            </div>

            <div className="projects-section container">
                <div className="projects-grid">
                    {projects.map((project) => (
                        <div key={project.id} className="project-card">
                            <div className="project-card-image-wrapper">
                                <img src={project.image} alt={project.title} />
                            </div>
                            <div className="project-card-content">
                                <h3 className="project-card-title">{project.title}</h3>
                                <p className="project-card-location">{project.location}</p>
                                <div className="project-card-hover-bar"></div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}

export default Project;
