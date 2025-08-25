// import './bootstrap';
import '../css/app.css';
import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter } from 'react-router-dom';
import Contact from './Components/Contact';
import BlogDetails from './Components/BlogDetails';
import ProductDetails from './Components/ProductDetails';
import AboutUs from './Components/AboutUs';
import MyMiro from './Components/MyMiro/MyMiro';
import Home from './Components/Home';
import Products from './Components/Products';
import Projects from './Components/Projects';
import Services from './Components/Services';
import Blog from './Components/Blog';
import Privacy from './Components/Privacy';
import Terms from './Components/Terms';
import CategoryDetails from './Components/CategoryDetails';
import ProjectDetails from './Components/Projects/ProjectDetails/ProjectDetails';
import ProductBlog from './Components/ProductBlog';
import BlogInstallation from './Components/BlogInstallation';
import Login from './Components/MyMiro/Auth/Login';
import Signup from './Components/MyMiro/Auth/Signup';
import Footer from './Components/Footer';
import Header from './Components/Header';
import AdminLogin from './Components/Admin/Auth/Login';
import Dashboard from './Components/Admin/Dashboard';
import AttributesList from './Components/Admin/AttributesList';
import AddAttribute from './Components/Admin/AddAttribute';
import EditAttribute from './Components/Admin/EditAttribute';   

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// Create a wrapper component that includes the Router
const AppWrapper = ({ children }) => (
    <BrowserRouter>
        {children}
    </BrowserRouter>
);

// Mount components when their root elements exist
const contactRoot = document.getElementById('contact-root');
if (contactRoot) {
    createRoot(contactRoot).render(
        <AppWrapper>
            <Contact />
        </AppWrapper>
    );
}

// Mount BlogDetails component
const blogDetailsRoot = document.getElementById('blog-details');
if (blogDetailsRoot) {
    createRoot(blogDetailsRoot).render(
        <AppWrapper>
            <BlogDetails />
        </AppWrapper>
    );
}

// Mount ProductDetails component
const productDetailsRoot = document.getElementById('product-details');
if (productDetailsRoot) {
    const modelNumber = productDetailsRoot.getAttribute('data-model-number');
    createRoot(productDetailsRoot).render(
        <AppWrapper>
            <ProductDetails modelNumber={modelNumber} />
        </AppWrapper>
    );
}

// Mount AboutUs component
const aboutUsRoot = document.getElementById('about-us');
if (aboutUsRoot) {
    createRoot(aboutUsRoot).render(
        <AppWrapper>
            <AboutUs />
        </AppWrapper>
    );
}

// Mount MyMiro component
const myMiroRoot = document.getElementById('mymiro-page');
if (myMiroRoot) {
    createRoot(myMiroRoot).render(
        <AppWrapper>
            <MyMiro />
        </AppWrapper>
    );
}

// Mount Home component
const homeRoot = document.getElementById('home-page');
if (homeRoot) {
    createRoot(homeRoot).render(
        <AppWrapper>
            <Home />
        </AppWrapper>
    );
}

// Mount Products component
const productsRoot = document.getElementById('products-page');
if (productsRoot) {
    const type = productsRoot.getAttribute('data-type');
    createRoot(productsRoot).render(
        <AppWrapper>
            <Products type={type} />
        </AppWrapper>
    );
}

// Mount Projects component
const projectsRoot = document.getElementById('projects-page');
if (projectsRoot) {
    createRoot(projectsRoot).render(
        <AppWrapper>
            <Projects />
        </AppWrapper>
    );
}

// Mount Services component
const servicesRoot = document.getElementById('services-page');
if (servicesRoot) {
    createRoot(servicesRoot).render(
        <AppWrapper>
            <Services />
        </AppWrapper>
    );
}

// Mount Blog component
const blogRoot = document.getElementById('blog-page');
if (blogRoot) {
    createRoot(blogRoot).render(
        <AppWrapper>
            <Blog />
        </AppWrapper>
    );
}

// Mount Privacy component
const privacyRoot = document.getElementById('privacy-page');
if (privacyRoot) {
    createRoot(privacyRoot).render(
        <AppWrapper>
            <Privacy />
        </AppWrapper>
    );
}

// Mount Terms component
const termsRoot = document.getElementById('terms-page');
if (termsRoot) {
    createRoot(termsRoot).render(
        <AppWrapper>
            <Terms />
        </AppWrapper>
    );
}

// Mount CategoryDetails component
const categoryDetailsRoot = document.getElementById('category-details');
if (categoryDetailsRoot) {
    const categoryId = categoryDetailsRoot.getAttribute('data-id');
    createRoot(categoryDetailsRoot).render(
        <AppWrapper>
            <CategoryDetails id={categoryId} />
        </AppWrapper>
    );
}

// Mount ProjectDetails component
const projectDetailsRoot = document.getElementById('project-details');
if (projectDetailsRoot) {
    const projectId = projectDetailsRoot.getAttribute('data-project-id');
    createRoot(projectDetailsRoot).render(
        <AppWrapper>
            <ProjectDetails id={projectId} />
        </AppWrapper>
    );
}

// Mount ProductBlog component
const productBlogRoot = document.getElementById('product-blog');
if (productBlogRoot) {
    createRoot(productBlogRoot).render(
        <AppWrapper>
            <ProductBlog />
        </AppWrapper>
    );
}

// Mount BlogInstallation component
const blogInstallationRoot = document.getElementById('blog-installation');
if (blogInstallationRoot) {
    createRoot(blogInstallationRoot).render(
        <AppWrapper>
            <BlogInstallation />
        </AppWrapper>
    );
}

// Mount Login component
const loginRoot = document.getElementById('mymiro-login-page');
if (loginRoot) {
    createRoot(loginRoot).render(
        <AppWrapper>
            <Login />
        </AppWrapper>
    );
}

// Mount Signup component
const signupRoot = document.getElementById('mymiro-signup-page');
if (signupRoot) {
    createRoot(signupRoot).render(
        <AppWrapper>
            <Signup />
        </AppWrapper>
    );
}

// Mount Footer component
const footerRoot = document.getElementById('footer-root');
if (footerRoot) {
    createRoot(footerRoot).render(
        <AppWrapper>
            <Footer />
        </AppWrapper>
    );
}

// Mount Header component
const headerRoot = document.getElementById('header-root');
if (headerRoot) {
    createRoot(headerRoot).render(
        <AppWrapper>
            <Header />
        </AppWrapper>
    );
}

// Mount AdminLogin component
const adminLoginRoot = document.getElementById('admin-login-root');
if (adminLoginRoot) {
    createRoot(adminLoginRoot).render(
        <AppWrapper>
            <AdminLogin />
        </AppWrapper>
    );
}

// Mount Dashboard component
const dashboardRoot = document.getElementById('dashboard-root');
if (dashboardRoot) {
    createRoot(dashboardRoot).render(
        <AppWrapper>
            <Dashboard />
        </AppWrapper>
    );
}


// Mount AttributesList component
const attributesListRoot = document.getElementById('attributes-list');
if (attributesListRoot) {
    createRoot(attributesListRoot).render(
        <AppWrapper>
            <AttributesList />
        </AppWrapper>
    );
}

// Mount AddAttribute component
const addAttributeRoot = document.getElementById('add-attribute');
if (addAttributeRoot) {
    createRoot(addAttributeRoot).render(
        <AppWrapper>
            <AddAttribute />
        </AppWrapper>
    );
}

// Mount EditAttribute component
const editAttributeRoot = document.getElementById('edit-attribute');    
if (editAttributeRoot) {
    createRoot(editAttributeRoot).render(
        <AppWrapper>
            <EditAttribute />
        </AppWrapper>
    );
}       
