import React from 'react';
import ProjectWorkspace from "../ProjectWorkspace";

class Project extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            tables: null
        };
    }

    componentDidMount() {
        fetch('/api/tables?user_id=&project_id=', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'Authorization': 'Bearer ' + localStorage.getItem('authToken')
            }
        })
            .then(response => response.json())
            .then(response => {
                console.log(response);
            });
        console.log(localStorage.getItem('authToken'), );
    }

    render() {
        return (
            <div className={"project"}>
                <ProjectWorkspace/>
            </div>
        );
    }
}

export default Project