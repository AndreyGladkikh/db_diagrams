import React from 'react';
import ProjectWorkspace from "../ProjectWorkspace";

class Project extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            tables: null
        };

        this.handleClickCreateTable = this.handleClickCreateTable.bind(this);
    }

    componentDidMount() {
        fetch('/api/projects/{:projectId}/tables', {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('authToken')
            }
        })
            .then(response => response.json())
            .then(response => {
                console.log(response);
            });
    }

    handleClickCreateTable() {
        var body = [];
        for (var property in this.state) {
            var encodedKey = encodeURIComponent(property);
            var encodedValue = encodeURIComponent(this.state[property]);
            body.push(encodedKey + "=" + encodedValue);
        }
        body = body.join("&");

        fetch('/api/projects/:projectId/tables', {
            method: 'POST',
            body: body,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8',
                'Authorization': 'Bearer ' + localStorage.getItem('authToken')
            }
        })
            .then(response => response.json())
            .then(response => console.log(response))
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