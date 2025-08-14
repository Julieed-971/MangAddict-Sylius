import { Application } from '@hotwired/stimulus';
import DarkModeController from './controllers/dark_mode_controller';

// Registers Stimulus controllers from controllers.json and in the controllers/ directory
export const app = Application.start();
// register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);
app.register('dark_mode', DarkModeController);