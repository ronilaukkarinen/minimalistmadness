export default function getLocalization(stringKey) {
  if (typeof window.minimalistmadness_screenReaderText === 'undefined' || typeof window.minimalistmadness_screenReaderText[stringKey] === 'undefined') {
    // eslint-disable-next-line no-console
    console.error(`Missing translation for ${stringKey}`);
    return '';
  }
  return window.minimalistmadness_screenReaderText[stringKey];
}
