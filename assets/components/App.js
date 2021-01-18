import React from 'react';
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link
} from "react-router-dom";
import Header from "./Header";
import Routes from "./Routes";

class App extends React.Component {
    state = {
    };

    render() {
        return (
            <Router>
                <Header />
                <Routes />
            </Router>
        );
    }
}

export default App;