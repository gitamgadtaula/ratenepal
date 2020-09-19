export default function getRating(value) {
  console.log(value);
  const length = value.length;
  if (length === 0) {
    return "0";
  }
  const sum = value.reduce((acc, item) => acc + item.rating, 0);
  return (sum / length).toFixed(1);
}
