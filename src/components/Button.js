
const Button = ({ onClick }) => {
  return (
    <div className="btn-wrap">
      <button id="change" onClick={onClick}>くばる</button>
    </div>
  );
}

export default Button
