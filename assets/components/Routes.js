import React from 'react';
import {
    Switch,
    Route,
    useRouteMatch
} from "react-router-dom";
import SignUp from "./pages/SignUp";
import SignIn from "./pages/SignIn";
import Home from "./pages/Home";
import Projects from "./pages/Projects";
import Project from "./pages/Project";

function Routes() {
    let match = useRouteMatch();

    return (
        <Switch>
            <Route path="/signup">
                <SignUp />
            </Route>
            <Route path="/signin">
                <SignIn />
            </Route>
            <Route path="/projects">
                <Projects />
            </Route>
            <Route path="/project">
                <Project />
            </Route>
            <Route path={`${match.path}/projects/:projectId`}>
                <Project />
            </Route>
            <Route path="/">
                <Home />
            </Route>
        </Switch>
    )
}

export default Routes;