import React from 'react';
import './ProjectWorkspace.scss';
import ContextMunu from "./ContextMenu";

class ProjectWorkspace extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            contextMenu: {
                xPos: null,
                yPos: null,
                showMenu: false,
            },
            tables: null
        };

        this.handleContextMenu = this.handleContextMenu.bind(this);
        this.handleClick = this.handleClick.bind(this);
    }

    componentDidMount() {
        fetch('/api/projects/{:projectId}/tables', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'Authorization': 'Bearer ' + localStorage.getItem('authToken')
            }
        })
            .then(response => response.json())
            .then(response => {
                this.setState({
                    tables: response
                });
            });
    }

    handleContextMenu(e) {
        e.preventDefault();
        if(!e.target.classList.contains('context-menu__tab')) {
            this.setState({
                contextMenu: {
                    xPos: `${e.pageX}px`,
                    yPos: `${e.pageY}px`,
                    showMenu: true,
                }
            });
        }
    }

    handleClick(e) {
        if(!e.target.classList.contains('context-menu__tab') && this.state.contextMenu.showMenu === true) {
            this.setState({
                contextMenu: {
                    showMenu: false,
                }
            });
        }
    }

    render() {
        const {showMenu, xPos, yPos} = this.state.contextMenu;
        return (
            <div className={"project-workspace"} onClick={this.handleClick} onContextMenu={this.handleContextMenu}>
                <ContextMunu showMenu={showMenu} xPos={xPos} yPos={yPos} />
            </div>
        );
    }
}

export default ProjectWorkspace