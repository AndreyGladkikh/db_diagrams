import React from 'react';
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link
} from "react-router-dom";

class Table extends React.Component {
    state = {
    };

    render() {
        return (
            <div className={"table"}>
                {this.props.map(function(item) {

                })}
            </div>
        );
    }
}

export default Table;