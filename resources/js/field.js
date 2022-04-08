import IndexField from './components/IndexField';
import DetailField from './components/DetailField';
import FormField from './components/FormField';

Nova.booting((app, store) => {
  app.component('IndexTinymceField', IndexField);
  app.component('DetailTinymceField', DetailField);
  app.component('FormTinymceField', FormField);
});
