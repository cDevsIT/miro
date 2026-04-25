import React from 'react';
import '../../../css/Project.css';

function Project() {
    const projects = Array.isArray(window.projectsData) ? window.projectsData : [];
    const firstProject = projects.length > 0 ? projects[0] : null;
    const remainingProjects = projects.slice(1);

    const getImageUrl = (path) => {
        if (!path) return '';
        return `/storage/${path}`;
    };

    const getIntro = (text) => {
        if (!text) return '';
        return text.length > 420 ? `${text.slice(0, 420)}...` : text;
    };

    return (
        <div>
            {firstProject ? (
                <div className="project-page-container">
                    <div className="project-page-content">
                        <div className="project-page-image">
                            <div className="project-page-image-wrapper">
                                <img
                                    src={getImageUrl(firstProject.feature_image)}
                                    alt={firstProject.title}
                                />
                            </div>
                        </div>
                        <div className="project-page-text">
                            <h1 className="project-page-title">{firstProject.title}</h1>
                            <p className="project-page-location">{firstProject.info_location || ''}</p>
                            <p className="project-page-description">{getIntro(firstProject.intro)}</p>
                            <a href={`/projects/${firstProject.slug}`} className="project-page-button">
                                Learn more
                            </a>
                        </div>
                    </div>
                </div>
            ) : (
                <div className="container py-5">
                    <p className="text-muted">No projects found.</p>
                </div>
            )}

            {remainingProjects.length > 0 && (
                <div className="projects-section container">
                    <div className="projects-grid">
                        {remainingProjects.map((project) => (
                        <a key={project.id} href={`/projects/${project.slug}`} className="project-card">
                            <div className="project-card-image-wrapper">
                                <img src={getImageUrl(project.feature_image)} alt={project.title} />
                            </div>
                            <div className="project-card-content">
                                <h3 className="project-card-title">{project.title}</h3>
                                <p className="project-card-location">{project.info_location || ''}</p>
                                <div className="project-card-hover-bar"></div>
                            </div>
                        </a>
                        ))}
                    </div>
                </div>
            )}
        </div>
    );
}

export default Project;
