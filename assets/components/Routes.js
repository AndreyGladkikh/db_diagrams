import React from 'react';
import {
    Switch,
    Route,
    useRouteMatch
} from "react-router-dom";
import SignUp from "./pages/SignUp";
import SignIn from "./pages/SignIn";
import ProjectWorkspace from "./pages/ProjectWorkspace";
import Home from "./pages/Home";

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
            <Route path={`${match.path}/projects/mine/:projectId`}>
                <ProjectWorkspace />
            </Route>
            <Route path="/project">
                <ProjectWorkspace />
            </Route>
            <Route path="/">
                <Home />
            </Route>
        </Switch>
    )
}

export default Routes;