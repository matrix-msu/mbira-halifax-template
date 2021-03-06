![mbira logo](http://mbira.matrix.msu.edu/wp-content/uploads/2015/03/Mbira_Logo_Horizontal.png "mbira logo")

mbira
=====

Currently in development at [MATRIX: The Center for Digital Humanities and Social Sciences](http://matrix.msu.edu), mbira is a platform to build, serve, and manage native and web-based mobile heritage experiences. The goal of the project is to create a constellation of open source tools (existing and purpose built) that will lower the technical bar for individuals, projects, and institutions interested in building rich, engaging, and sustainable place-based and mobile heritage experiences.  

### “Space and Landscape as Museum”

Based on the metaphor of “space and landscape as museum,” mbira lets users create mobile experience in which locations and areas are organized into curated exhibits displayed within a rich, interactive map interface. Each exhibit location contains information and rich media (video, audio, and imagery) about that location and well as the narrative about the associated scholarly work (excavation, survey, historical and heritage research, etc)

### A Constellation of Open Source Tools

1. Cloud-based Content Management System: mbira projects are created and managed using a cloud-based digital repository platform or CMS. All content (exhibits, locations, and location content) are added, edited, and updated from within an open source digital repository platform or CMS. When app creators or editors add new project content or edit existing project content, changes dynamically appear in the project’s public native mobile app or mobile website.  This public beta release was developed to function on top of [KORA](http://kora.matrix.msu.edu).  The ultimate goal is to develop mbira for additional digital repository platforms and CMSs, such as [Omeka](http://www.omeka.org), [WordPress](http://wordpress.org), [Drupal](http://drupal.org), [ArchiveSpace](http://archivespace.org), and [Arches](http://archesproject.org)

2. mbira plugin: the mbira plugin (which is installed on top of the user’s chosen digital repository platform or content management system) is the core authoring environment in mbira’s constellation of open source tools. The mbira plugin facilitates the creation of mobile projects and their associated exhibits, as well as all locations, areas, and explorations (and their associated content).  The mbira plugin also allows creators and editors to manage all social aspects of their mobile applications. In addition, the plugin lets users manage all of the device specific deployments of their mobile heritage experience (iOS, Android, mobile-first responsive web).

3. Mobile Front-end Templates: the mbira constellation of tools includes elegantly designed (and well documented) native mobile (iOS and Android) and mobile-web stock templates that individuals, projects, or institutions can use as-is or modify as they see fit. While the templates are designed primarily for those with minimal programming experience, they can also serve as a project jump-start for more seasoned developers. The templates are built to dynamically display content (exhibits, places, spaces, explorations) authored in the mbira plugin. As with all of the other components of the mbira platform, the mobile templates are available to users for free under an open source license. This community beta release includes two mobile first web templates ([Cusco](https://github.com/matrix-msu/mbira-cusco-template) and [Halifax](https://github.com/matrix-msu/mbira-halifax-template)).

### Halifax

Halifax is one of two mobile-first front end webs tempaltes included in this community beta release (the other being [Cusco](https://github.com/matrix-msu/mbira-cusco-template)).  Interested in seeing Halifax in action?  Check out [Colonial Cartagena](http://colonialcartagena.matrix.msu.edu/), an exemplar mbira project built by [Ana Maria Silva](https://twitter.com/anamsilva29) (a PhD Candidate in History at the University of Michigan) that allows people to explore historic port and fortress of Cartegena which has been designated UNESCO World Heritage site
 
### Current Development Status & Roadmap

Information on our current and future work can be found at [Where we are, and where we are going: the present and future of mbira](http://mbira.matrix.msu.edu/where-we-are-and-where-we-are-going/)

### Installation Instructions

The current version of the mbira authoring tool requires [KORA 2.6.2](https://github.com/matrix-msu/kora)

Once you have downloaded and installed [KORA](http://kora.marix.msu.edu), follow the directions at [How to Install the mbira Plugin](https://github.com/matrix-msu/mbira-plugin/wiki/How-to-install-the-Mbira-plugin) to install the mbira authring plugin.

Once installed, you can start creating mbira projects.  Documentation on how to create and manage mbira projects can be found [here](https://github.com/matrix-msu/mbira-plugin/wiki).

To connect Halifax to your mbira installation, follow the instructions [here(https://github.com/matrix-msu/mbira-halifax-template/wiki).

### mbira Sandbox

Want to play around with the current build of KORA's mbira authoring plugin (complete with all of the bugs and un-implemented features)?  Head on over to [mbira sandbox](http://mbira.matrix.msu.edu/try) to give it a test drive (username: demo & password: demodemo).
