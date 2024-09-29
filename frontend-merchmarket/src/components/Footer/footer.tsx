import { Link } from "react-router-dom";
import FooterLogo from "./footer-logo";
import "./footer.css";

function Footer() {
  return (
    <footer className="footer">
      <div className="footer-top">
        <div className="footer-logo">
          <Link to="/"><FooterLogo /></Link>
        </div>
        <div className="footer-list-container">
          <ul className="footer-columns">
            <li className="footer-columns-list">
              <span className="list-title">Категории</span>
              <ul>
                <li>
                  <Link to="/">Одежда и аксессуары</Link>
                </li>
                <li>
                  <Link to="/">Канцелярия</Link>
                </li>
                <li>
                  <Link to="/">Посуда</Link>
                </li>
                <li>
                  <Link to="/">Электроника</Link>
                </li>
              </ul>
            </li>
            <li className="footer-columns-list">
              <span className="list-title">О компании</span>
              <ul>
                <li>
                  <Link to="/">О нас</Link>
                </li>
                <li>
                  <Link to="/">Вакансии</Link>
                </li>
                <li>
                  <Link to="/">Контакты</Link>
                </li>
              </ul>
            </li>
            <li className="footer-columns-list">
              <span className="list-title">Полезные ссылки</span>
              <ul>
                <li>
                  <Link to="/">Помощь</Link>
                </li>
                <li>
                  <Link to="/">Личный профиль</Link>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div className="footer-bottom">
        <div className="footer-social">
          <a href="#"><img src="../telegram.png" alt="icon-telegram" /></a>
          <a href="#"><img src="../instagram.png" alt="icon-instagram"/></a>
          <a href="#"><img src="../tiktok.png" alt="icon-tiktok"/></a>
        </div>
        <p className="footer-copyright">
        © 2007-2024 <span className="flip-name">ТОО «Flip.kz»</span> Казахстан
        </p>
      </div>
    </footer>
  );
}

export default Footer;
