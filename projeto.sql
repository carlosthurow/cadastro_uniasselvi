create database cadastro_uniasselvi
default character set utf8
default collate utf8_general_ci;

use cadastro_uniasselvi;

create table clientes (
CodCliente int not null auto_increment,
NomeCliente varchar(100) not null,
CPF char(11) not null unique,
Email nvarchar(50),
primary key (CodCliente)
)default charset = utf8;

create table produtos (
CodProduto int not null auto_increment,
NomeProduto varchar(100),
CodBarras varchar(20) not null,
ValorUnitario float(7,2) not null,
primary key (CodProduto)
)default charset = utf8;

create table pedidos (
NumeroPedido int not null auto_increment,
DtPedido date not null,
CodCliente int not null,
primary key (NumeroPedido),
foreign key (CodCliente) references clientes(CodCliente)
)default charset = utf8;

create table pedidos_produtos(
Id int not null auto_increment,
Quantidade int not null,
NumeroPedido int not null,
CodProduto int not null,
primary key (Id),
foreign key (NumeroPedido) references pedidos(NumeroPedido),
foreign key (CodProduto) references produtos(CodProduto)
)default charset = utf8;

insert into clientes (CodCliente, NomeCliente, CPF, Email) values (default, 'Carlos', '01234567890', 'carlos@gmail.com');
insert into produtos (CodProduto, NomeProduto, CodBarras, ValorUnitario) values (default, 'Produto de teste', '01234567890123456', '132.56');
insert into pedidos (NumeroPedido, DtPedido, CodCliente) values (default, '2019-05-22', '1');
insert into pedidos_produtos (Id, Quantidade, NumeroPedido, CodProduto) values (default, '5', '1', '1');

select * from clientes;
select * from produtos;
select * from pedidos;
select * from pedidos_produtos;
