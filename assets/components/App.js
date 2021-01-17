import React from 'react';
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link
} from "react-router-dom";
import Header from "./Header";

class App extends React.Component {
    state = {
    };

    render() {
        return (
            <Router>
                <Header />
            </Router>
        );
    }
}

export default App;