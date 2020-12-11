from diagrams import Cluster, Diagram
from diagrams.aws.network import ELB
from diagrams.aws.network import Route53
from diagrams.aws.compute import ECS
from diagrams.aws.database import RDS

graph_attr = {
    "fontsize": "12",
    "bgcolor": "transparent"
}

with Diagram("", show=False):
    dns = ELB("")

    webfront = ECS("webfront(nginx)")

    with Cluster("local internal DNS"):
        with Cluster("frontend"):
            appfront = ECS("appfront")

        with Cluster("backend"):
            webback = ECS("webback(nginx)")
            appback = ECS("appback")

    rds = RDS("")

    dns >> webfront >> appfront >> webback >> appback >> rds
