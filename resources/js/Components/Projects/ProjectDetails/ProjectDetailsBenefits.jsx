const ProjectDetailsBenefits = ({ data }) => {

    return (
        <div className="project-details-benefits container">
            <img
                src={data?.image}
                alt={data?.image}
                className="project-details-benefits-image"
            />
            <h2 className="project-details-benefits-title">{data?.title}</h2>
            <p className="project-details-benefits-description">
                {data?.description}
            </p>
        </div>
    );
};

export default ProjectDetailsBenefits;